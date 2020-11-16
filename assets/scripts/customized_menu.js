$(function() {
  
  "use strict";

  //////////////////////////////////////////////////////////////////////////////
  //////////////////////////////////////////////////////////////////////////////
  //
  // H E L P E R    F U N C T I O N S
  //
  //////////////////////////////////////////////////////////////////////////////
  //////////////////////////////////////////////////////////////////////////////

  /**
   * Function to check if we clicked inside an element with a particular class
   * name.
   * 
   * @param {Object} e The event
   * @param {String} className The class name to check against
   * @return {Boolean}
   */
    function clickInsideElement( e, className ) {
      var el = e.srcElement || e.target;
      
      if ( el.classList.contains(className) ) {
        return el;
      } else {
        while ( el = el.parentNode ) {
          if ( el.classList && el.classList.contains(className) ) {
            return el;
          }
        }
      }

      return false;
    }

  /**
   * Get's exact position of event.
   * 
   * @param {Object} e The event passed in
   * @return {Object} Returns the x and y position
   */
  function getPosition(e) {
    var posx = 0;
    var posy = 0;

    if (!e) var e = window.event;
    
    if (e.pageX || e.pageY) {
      posx = e.pageX;
      posy = e.pageY;
    } else if (e.clientX || e.clientY) {
      posx = e.clientX + document.body.scrollLeft + document.documentElement.scrollLeft;
      posy = e.clientY + document.body.scrollTop + document.documentElement.scrollTop;
    }

    return {
      x: posx,
      y: posy
    }
  }

  //////////////////////////////////////////////////////////////////////////////
  //////////////////////////////////////////////////////////////////////////////
  //
  // C O R E    F U N C T I O N S
  //
  //////////////////////////////////////////////////////////////////////////////
  //////////////////////////////////////////////////////////////////////////////
  
  /**
   * Variables.
   */
  var contextMenuClassName = "context-menu";
  var contextMenuItemClassName = "context-menu__item";
  var contextMenuLinkClassName = "context-menu__link";
  var contextMenuActive = "context-menu--active";

  var taskItemClassName = "file_list";
  var taskItemInContext;

  var clickCoords;
  var clickCoordsX;
  var clickCoordsY;

  var menu = document.querySelector("#context-menu");
  var menuItems = menu.querySelectorAll(".context-menu__item");
  var menuState = 0;
  var menuWidth;
  var menuHeight;
  var menuPosition;
  var menuPositionX;
  var menuPositionY;

  var windowWidth;
  var windowHeight;
  var file_clicked;
  var po;
  /**
   * Initialise our application's code.
   */
  function init() {
    contextListener();
    clickListener();
    keyupListener();
    resizeListener();
  }

  /**
   * Listens for contextmenu events.
   */
  function contextListener() {
    document.addEventListener( "contextmenu", function(e) {
      taskItemInContext = clickInsideElement( e, taskItemClassName );
      
      if ( taskItemInContext ) {

        //console.log(taskItemInContext.className);
        var idd = taskItemInContext.id;
        file_clicked = $("#"+idd.toString()).attr("file-id");
        var y = $("#"+idd.toString()).attr("data-id");
        //console.log(y);
        var poe =  document.getElementById('para_owner'+y.toString());
        po = $("#"+'para_owner'+y.toString()).text();
        //console.log(po);



        e.preventDefault();
        toggleMenuOff();
        toggleMenuOn();
        positionMenu(e);
        setLinks();
      } else {
        taskItemInContext = null;
        toggleMenuOff();
      }
    });
  }

  /**
   * Listens for click events.
   */
  function clickListener() {
    document.addEventListener( "click", function(e) {
      var clickeElIsLink = clickInsideElement( e, contextMenuLinkClassName );

      if ( clickeElIsLink ) {
        //e.preventDefault();
        toggleMenuOff();
        menuItemListener( clickeElIsLink );
      } else {
        var button = e.which || e.button;
        if ( button === 1 ) {
          toggleMenuOff();
        }
      }
    });
  }

  /**
   * Listens for keyup events.
   */
  function keyupListener() {
    window.onkeyup = function(e) {
      if ( e.keyCode === 27 ) {
        toggleMenuOff();
      }
    }
  }

  /**
   * Window resize event listener
   */
  function resizeListener() {
    window.onresize = function(e) {
      toggleMenuOff();
    };
  }

  /**
   * Turns the custom context menu on.
   */
  function toggleMenuOn() {
    if ( menuState !== 1 ) {
      menuState = 1;
      menu.classList.add( contextMenuActive );
      if(po != "YOU"){
        $("#rename_option").css("display","none");
        $("#delete_option").css("display","none");
        $("#share_option").css("display","none");
      }
      else{
        $("#rename_option").css("display","block");
        $("#delete_option").css("display","block");
        $("#share_option").css("display","block");
      }
    }
  }

  /**
   * Turns the custom context menu off.
   */
  function toggleMenuOff() {
    if ( menuState !== 0 ) {
      menuState = 0;
      menu.classList.remove( contextMenuActive );
    }
  }

  /**
   * Positions the menu properly.
   * 
   * @param {Object} e The event
   */
  function positionMenu(e) {
    clickCoords = getPosition(e);
    clickCoordsX = clickCoords.x;
    clickCoordsY = clickCoords.y;

    menuWidth = menu.offsetWidth + 4;
    menuHeight = menu.offsetHeight + 4;

    windowWidth = window.innerWidth;
    windowHeight = window.innerHeight;

    if ( (windowWidth - clickCoordsX) < menuWidth ) {
      menu.style.left = windowWidth - menuWidth + "px";
    } else {
      menu.style.left = clickCoordsX + "px";
    }

    if ( (windowHeight - clickCoordsY) < menuHeight ) {
      menu.style.top = windowHeight - menuHeight + "px";
    } else {
      menu.style.top = clickCoordsY + "px";
    }
  }

  /**
   * Dummy action function that logs an action when a menu item link is clicked
   * 
   * @param {HTMLElement} link The link that was clicked
   */



   function setLinks(){
        var id = taskItemInContext.getAttribute("data-id");
        //$('.link').attr("href", "http://www.google.com/");

        var para = document.getElementById('para'+id.toString());
        var id_name = "#"+"para"+id.toString();
        var fname = $(id_name.toString()).text();
        console.log(fname);
        download_file(fname);
   }

   function download_file(fname){
      var formData = new FormData();
      var xhr = new XMLHttpRequest();
      formData.append('fn',fname);

      xhr.onload = function(){
        console.log("in onload of customized_menu: download_file");
        var data = JSON.parse(this.responseText);
        console.log(data);
        $('#download_option').attr("href", data);
        //displayUpload(data);
        //location.reload();
      }

      xhr.open('post','download_file.php');
      xhr.send(formData);

   }



  function menuItemListener( link ) {
    console.log("in menuItemListener");
    var flag = link.getAttribute("data-action");
    var id = taskItemInContext.getAttribute("data-id");
    console.log( "Task ID - " + id + ", Task action - " + flag);
    //alert("Task ID - " + d_id + ", Task action - " + flag);


    var para = document.getElementById('para'+id.toString());
    var id_name = "#"+"para"+id.toString();
    var fname = $(id_name.toString()).text();
    //console.log(fname);
    
    if(flag == "rename"){
        console.log("Renaming");
          //pointer-events: none;
        onRename(fname);
    }
    if(flag == "delete"){
        delete_file(fname);
    }
    if(flag == "share"){
        onShare(fname);
    }


    toggleMenuOff();

  }


/******************************************************************/
                        /*  Renaming a File */
/******************************************************************/


  function onRename(fname){
    $("#rename_prompt_txt").attr("placeholder",fname);
    backgroundFades("rename_prompt");
      window.onkeyup = function(e) {
        if ( e.keyCode === 27 ) {
            backgroundBrightens("rename_prompt");
        }

        if ( e.keyCode === 13 ) {
            var newName = $("#rename_prompt_txt").val();
            if(newName.length == 0){
              newName = fname;
            }
            backgroundBrightens("rename_prompt");
            rename_file(fname,newName);
        }
      }
      $("#cancel_button").click(function(){
        backgroundBrightens("rename_prompt");
      });

      $("#ok_button").click(function(){
        var newName = $("#rename_prompt_txt").val();
        if(newName.length == 0){
          newName = fname;
        }
        backgroundBrightens("rename_prompt");
        rename_file(fname,newName);
      });
  }




  function rename_file(fname,newName){
/*      console.log("in rename_file function");
      console.log(fname);
      console.log(newName);*/
    var formData = new FormData();
    var xhr = new XMLHttpRequest();
    formData.append('fn',fname);
    formData.append('newName',newName);

    xhr.onload = function(){
      console.log("in onload of customized_menu: rename_file");
      var data = JSON.parse(this.responseText);
      console.log(data);
      //displayUpload(data);
      location.reload();
    }

    xhr.open('post','rename_file.php');
    xhr.send(formData);

  }


/******************************************************************/
                        /*  Renaming a File */
/******************************************************************/


/******************************************************************/
                        /*  Deleting a File */
/******************************************************************/

   function delete_file(fname){

      var formData = new FormData();
      var xhr = new XMLHttpRequest();
      formData.append('fn',fname);

      xhr.onload = function(){
        console.log("in onload of customized_menu: delete_file");
        var data = JSON.parse(this.responseText);
        console.log(data);
        //displayUpload(data);
        location.reload();
      }

      xhr.open('post','delete_file.php');
      xhr.send(formData);

   }


/******************************************************************/
                        /*  Deleting a File */
/******************************************************************/


/******************************************************************/
                        /*  Sharing a File */
/******************************************************************/


  function onShare(fname){
    backgroundFades("share_prompt");
    var xhr = new XMLHttpRequest();
    var formdata = new FormData();
    formdata.append('file_id',file_clicked);
    xhr.onload = function(){
      console.log("inside onLoad of customized_menu.js: onShare");
      var data = JSON.parse(this.responseText);
      console.log(data);
      displaydata(data);
      
    }

    xhr.open('post','share_with_friends.php');
    xhr.send(formdata);


    window.onkeyup = function(e) {
        if ( e.keyCode === 27 ) {
            backgroundBrightens("share_prompt");
        }

        if ( e.keyCode === 13 ) {
              /* This part is handled by share_with_friends.js */
        }
      }
      $("#cancel_button_share").click(function(){
        backgroundBrightens("share_prompt");
      });

      $("#ok_button_share").click(function(){
             /* This part is handled by share_with_friends.js */
      });

  }

  function displaydata(data){
      var shr_prmt = document.getElementById('frinds_list_container');
      $(shr_prmt).empty();
      var x,arr;

      for(x= 0;x<data.length;x=x+4){

        var frnd_holder = document.createElement('div');
        var img =  document.createElement('img');
        var p2 =  document.createElement('p');

        frnd_holder.setAttribute('class','frnd_holder_class');
        frnd_holder.setAttribute('id','frnd_holder'+ x.toString() );
        frnd_holder.setAttribute('data-id',data[x+2]);
        frnd_holder.setAttribute('select-id','no');
        frnd_holder.setAttribute('file-id',file_clicked);
        img.setAttribute('class','shr_res_img');
        p2.setAttribute('class','shr_res_p');

        $(img).attr("src",data[x+1]);
        $(p2).text(data[x]);

        if(data[x+3] == "yes"){
            frnd_holder.setAttribute('select-id','yes');
            $( frnd_holder ).css("background-color","#EF476F");
        }

        shr_prmt.appendChild(frnd_holder);
        frnd_holder.appendChild(img);
        frnd_holder.appendChild(p2);
      }


      $.getScript('assets/scripts/share_with_friends.js', function()
      {
          // script is now loaded and executed.
          // put your dependent JS here.
      });
  }






/******************************************************************/
                        /*  Sharing a File */
/******************************************************************/


/******************************************************************/
                        /*  HELPER Functions for Tasks */
/******************************************************************/


function backgroundFades(prompt_id){
    $("#list_container").css("pointer-events", "none");
    $("#dropzone").css("pointer-events", "none");
    $("#list_container" ).fadeTo( "slow",.3, function() {
        // Animation complete
    });
    $("#dropzone" ).fadeTo( "slow",.3, function() {
        // Animation complete
    });

    $("#"+prompt_id).css("display", "initial");
}

function backgroundBrightens(prompt_id){
    $("#list_container").css("pointer-events", "auto");
    $("#dropzone").css("pointer-events", "auto");
    $( "#list_container" ).fadeTo( "slow",1, function() {
        // Animation complete
    });
    $( "#dropzone" ).fadeTo( "slow",1, function() {
        // Animation complete
    });

    $("#"+prompt_id).css("display", "none");
}

/*function handlerPromptKeyClick*/





/******************************************************************/
                        /*  HELPER Functions for Tasks */
/******************************************************************/


  /**
   * Run the app.
   */
  init();

});
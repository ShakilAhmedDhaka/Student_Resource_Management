$(document).ready(function(){


	var cnt = 1;
	var contextClassName = "icon-bell";

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




    var	xhr = new XMLHttpRequest();

    xhr.onload = function(){
		console.log("inside onLoad of notification.js");
		var data = JSON.parse(this.responseText);
		console.log(data);
		displaydata(data);
	}

  	xhr.open('post','get_notification_details.php');
	xhr.send();


    var displaydata  = function(data){

    	var notif_bar = document.getElementById('notif_bar');
    	var x;
		
/*		notif_bar_list2 = document.createElement('div');
		notif_bar_list2.setAttribute('id','notif_bar_list');
		notif_bar.appendChild(notif_bar_list2);*/


		for(x= 0;x<data.length;x=x+1){
			filed = data[x];
			arr = filed.split('#');
		

			var notif_bar_list = document.createElement('div');
			var img =  document.createElement('img');
			var p2 =  document.createElement('p');
			var p3 =  document.createElement('p');


			notif_bar_list.setAttribute('class','notif_bar_list');
			notif_bar_list.setAttribute('id','notif_bar_list'+arr[0].toString());
			notif_bar_list.setAttribute('data-id',arr[0].toString());
			img.setAttribute('class','notif_bar_list_img');
			//img.setAttribute('id','notif_bar_list_img'+x.toString());
			//img.href(arr[2]);
			$(img).attr("src",arr[5]);
			$(p2).text(arr[1]);
			//$(p3).text(arr[1]);

			notif_bar.appendChild(notif_bar_list);
			notif_bar_list.appendChild(img);
			notif_bar_list.appendChild(p2);
			//notif_bar_list.appendChild(p3);
			if(arr[2] == "friend_request"){
				var btn_container = document.createElement('div');
				var btn1 =  document.createElement('button');
				var accept = document.createTextNode("Accept");
				var btn2 =  document.createElement('button');
				var del = document.createTextNode("Delete");

				btn_container.setAttribute('class','notif_bar_list_btn_container');
				btn1.setAttribute('class','notif_bar_list_btn_accept');
				btn1.setAttribute('id','notif_bar_list_btn_accept'+x.toString());
				//$(".notif_bar_list_btn_accept").text('Accept');
				btn2.setAttribute('class','notif_bar_list_btn_delete');
				btn2.setAttribute('id','notif_bar_list_btn_delete'+x.toString());
				//$(".notif_bar_list_btn_delete").text('Delete');

				notif_bar_list.appendChild(btn_container);
				btn_container.appendChild(btn1);
				btn1.appendChild(accept);
				btn_container.appendChild(btn2);
				btn2.appendChild(del);
			}

		}


   	}


	document.addEventListener( "click", function(e) {
		var clickeElIsLink = clickInsideElement( e, contextClassName );
		if(clickeElIsLink){
			
			console.log("notification searched");

			if(cnt==1){
				$("#notif_bar").css("display","initial");
				cnt = 0;
			}
			else{
				$("#notif_bar").css("display","none");
				cnt = 1;
			}
			
		}
		else{
			$("#notif_bar").css("display","none");
			cnt = 1;
		}

		get_list = clickInsideElement( e, 'notif_bar_list' );
		if(get_list && (e.target.className== "notif_bar_list_btn_delete" ||  e.target.className== "notif_bar_list_btn_accept" ) ){
			console.log(get_list.id);
			console.log(e.target.className);
			notif_id = get_list.id.split("notif_bar_list"); 
			console.log(notif_id[1]);

			var	xhr = new XMLHttpRequest();
			var formdata = new FormData();

			formdata.append('notif_idd',notif_id[1]);
			if(e.target.className == "notif_bar_list_btn_delete")
				formdata.append('mode','delete');
			if(e.target.className == "notif_bar_list_btn_accept")
				formdata.append('mode','accept');

		    xhr.onload = function(){
				console.log("inside onLoad of notification.js: for reply_notification");
				var data = JSON.parse(this.responseText);
				console.log(data);
				location.reload();
				//displaydata(data);
			}

		  	xhr.open('post','reply_notification.php');
			xhr.send(formdata);


		}
		

	});

	/*$(".notif_bar_list_btn_accept").click(function(e){
		var el = e.srcElement || e.target;

		if ( el.classList.contains(className) ) {
	        return el;
	    } 
	    else{
	        while ( el = el.parentNode ){
	          if ( el.classList && el.classList.contains(className) ) {
	            return el;
	          }
	        }
	    }

	});*/


	
});

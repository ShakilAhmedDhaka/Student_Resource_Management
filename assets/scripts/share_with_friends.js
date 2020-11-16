$(document).ready(function(){

	console.log("in share_with_friends.js");

	document.addEventListener( "click", function(e) {
		var item = clickInsideElement( e, "frnd_holder_class" )
		if(item){
			var list_id = item.id;
			var select_id = $("#"+list_id.toString()).attr("select-id");
			console.log(select_id);

			if(select_id == "no"){
				$("#"+list_id.toString()).css("background-color","#EF476F");
				$("#"+list_id.toString()).attr('select-id','yes');
			}
			else{
				$("#"+list_id.toString()).css("background-color","#BBDEFB");
				$("#"+list_id.toString()).attr('select-id','no');
			}
		}

		if(e.target.className == "rename_buttons"){
			btn_id = e.target.id;
			if(btn_id == "ok_button_share"){
				console.log(btn_id);
				var ids = "";
				var file_id ;
				var cnt = 0;
				$('.frnd_holder_class').each(function(i, obj) {
					cnt = cnt+1;
				    var list_id = obj.id;
				    //console.log(list_id);
				    var select_id = $("#"+list_id.toString()).attr("select-id");
				    file_id = $("#"+list_id.toString()).attr("file-id");
				    //console.log(file_id);
				    if(select_id == "yes"){
				    	var data_id = $("#"+list_id.toString()).attr("data-id");
				    	ids = ids + "#"+data_id.toString();
				    	//console.log(data_id);
				    }

				});

				if(cnt==0){
					location.reload();
				}
				//console.log(ids);

				var xhr = new XMLHttpRequest();
				var formdata = new FormData();
				formdata.append('ids',ids);
				formdata.append('file_id',file_id);
			    xhr.onload = function(){
			      console.log("inside onLoad of share_with_friends.js: addEventListener");
			      var data = JSON.parse(this.responseText);
			      console.log(data);
			      location.reload();
			      //displaydata(data);
			      
			    }

			    xhr.open('post','share_with_friends2.php');
			    xhr.send(formdata);


			}
		}

	});






/************************************************************************/
/*                       HELPER FUNCTIONS                               */
/************************************************************************/

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


});
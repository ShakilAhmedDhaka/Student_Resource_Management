$(document).ready(function(){



	$("#search_input").keyup(function (e) {
    if (e.keyCode == 13) {
    	$("#search_res").children("#search_res_img").remove();
    	$("#search_res").children("#search_res_p").remove();

    	$("#search_res").css("display","block");

        var sfrnd = $('#search_input').val();

        var	xhr = new XMLHttpRequest();
        var formdata = new FormData();
        formdata.append('femail',sfrnd);

	    xhr.onload = function(){
			console.log("inside onLoad of search_in_profile.js");
			var data = JSON.parse(this.responseText);
			console.log(data);
			displaydata(data);
			
		}

	  	xhr.open('post','search_in_profile.php');
		xhr.send(formdata);
    }

    if (e.keyCode == 8 || e.keyCode == 27) {
    	$("#search_res").css("display","none");
    }

 });


var displaydata  = function(data){
	var search_res = document.getElementById('search_res');
	var x,arr;

	for(x= 0;x<data.length;x=x+1){
		filed = data[x];
		arr = filed.split('#');
		console.log(arr[0]);
		console.log(arr[1]);

		if(arr[0] == "wrong"){
			var p2 =  document.createElement('p');
			p2.setAttribute('id','search_res_p');
			$(p2).css("font-size","13px");
			$(p2).css("font-weight","bold");
			$(p2).text("wrong email: This person is not available on this site");
			search_res.appendChild(p2);
			break;
		}
		else if(arr[0] == "self"){
			location.reload();
			break;
		}

		var img =  document.createElement('img');
		var p2 =  document.createElement('p');

		img.setAttribute('id','search_res_img');
		p2.setAttribute('id','search_res_p');
		//img.setAttribute('id','notif_bar_list_img'+x.toString());
		//img.href(arr[2]);
		$(img).attr("src",arr[1]);
		$(p2).text(arr[0]);

		search_res.appendChild(img);
		search_res.appendChild(p2);
	}

}


$("#search_res").click( function(){

	var	xhr = new XMLHttpRequest();
    var formdata = new FormData();

    var sfrnd = $('#search_input').val();
    formdata.append('femail',sfrnd);

    xhr.onload = function(){
		console.log("inside onLoad of search_in_profile.js: search_res.click");
		var data = JSON.parse(this.responseText);
		console.log(data);
		window.location="see_profile.php";
		//displaydata(data);
	}

  	xhr.open('post','visit_profile.php');
	xhr.send(formdata);


});



});
$(document).ready(function(){

	$("#add_friend_button").css("display","none");
	$("#already_friends_button").css("display","none");
	$("#request_sent_button").css("display","none");
	$("#accept_request_button").css("display","none");

	var	xhr = new XMLHttpRequest();

    xhr.onload = function(){
		console.log("inside onLoad of send_frnd_req.js");
		var data = JSON.parse(this.responseText);
		console.log(data);
		display_button(data);
	}

  	xhr.open('post','check_friends.php');
	xhr.send();


	function display_button(data){
		if(data == "1"){
			$("#add_friend_button").css("display","block");
		}
		else if(data == "2" ){
			$("#already_friends_button").css("display","block");
		}
		else if(data == "3" ){
			$("#request_sent_button").css("display","block");
		}
		else{
			$("#accept_request_button").css("display","block");
		}
	}


	$("#add_friend_button").click( function(){
		window.location="send_frnd_req.php";
	});

	$("#accept_request_button").click( function(){
		window.location="accept_frnd_req.php";
	});

});
$(document).ready(function(){
		//console.log('Test.');
/*
	    $("#im").hover(function(){
	        $(this).css("background-color", "yellow");
	        }, function(){
	        $(this).css("background-color", "pink");
	    });*/

/*	    $("#im").click(function(){
	        $(this).css("background-color", "orange");
	        });*/


	document.addEventListener("click", function(event) {
	    var event_id = event.target.id;
	    if ( event.target.id == 'im' ) {
	    	event.preventDefault();
	        $('#' + event_id).css("background-color", "orange");
	        console.log("Clicked");
		}
	});

/*	document.addEventListener("drop", function(event) {
		console.log("inside drop");
	    event.preventDefault();
	    var event_id = event.target.id;
	    if ( event.target.id == 'im' ) {
	        $('#' + event_id).css("background-color", "black");
	        console.log("Dropped");
		}
	});
*/

	document.addEventListener("dragenter", function(event) {
	    if ( event.target.id == "im" ) {
	        event.target.style.border = "3px dotted red";
	    }
	});


	document.addEventListener("dragleave", function(event) {
	    if ( event.target.id == "im" ) {
	        event.target.style.border = "";
	    }
	});


	document.addEventListener("dragover", function(event) {
    	event.preventDefault();
	});


	document.addEventListener("drop", function(event) {
		console.log("inside drop");
	    event.preventDefault();
	    if ( event.target.id == "im" ) {
	        //document.getElementById("demo").style.color = "";
	        //event.target.style.border = "";
	        //var data = event.dataTransfer.getData("Text");
	        //event.target.appendChild(document.getElementById(data));
	        $('#im').css("background-color", "black");
	        console.log(event.dataTransfer.files);
	    	upload(event.dataTransfer.files);
	    }
	});



	var upload = function(files){
		console.log(files);
		var formData = new FormData();
		var	xhr = new XMLHttpRequest();
		var	x;

		for(x=0;x<files.length;x=x+1){
			formData.append('file[]',files[x]);
		}

		formData.append('status','propic');
		formData.append('filex',files[0]);

		xhr.onload = function(){
			var data = (this.responseText);
			console.log(data);

			//displayUpload(data);
			location.reload();
		}

		xhr.open('post','update_propic.php');
		xhr.send(formData);
	}


	var displayUpload  = function(data){
		var upload = document.getElementById('im'),
				anchor,
				x;
		for(x= 0;x<data.length;x=x+1){
			anchor = document.createElement('a');
			anchor.href = data[x].file;
			anchor.innerText = data[x].name;

			upload.appendChild(anchor);
			location.reload();
		}
	}



		
});
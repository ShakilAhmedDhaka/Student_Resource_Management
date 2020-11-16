//$(document).ready(function(id) {

function download(id){
	console.log("in download_file.js");
	console.log(id);

	
	//var list = $('.file_list[data-id=' + id +']');
	var para = document.getElementById('para'+id.toString());
	var id_name = "#"+"para"+id.toString();
	var fname = $(id_name.toString()).text();

	//console.log(list);
	console.log(para);
	//console.log(fname);
	//console.log(id_name);
	
	var formData = new FormData();
	var	xhr = new XMLHttpRequest();
	formData.append('file_name',fname);
	formData.append('dir','upload/Desert.jpg');
	//formData.append('did',id);

	var url1 = 'upload/' + fname;
	var url = url1.toString();
	console.log(url);

/*	xhr.onload = function(){
		var data = JSON.parse(this.responseText);
		console.log(data);

	}*/

	//xhr.open('post','download_file.php');
	//xhr.send(formData);

	$.ajax({
        type: 'post',
        url: 'test.php',
        data: {
            source1: "upload/Desert.jpg",
            source2: "some text 2"
        },
        success: function( data ) {
            console.log( data );
        }
    });


}	

//});
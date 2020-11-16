$(document).ready(function() {


	console.log("This is test.js");

	var	xhr = new XMLHttpRequest();

    xhr.onload = function(){
		console.log("This is test.js");
		var data = JSON.parse(this.responseText);
		console.log(data);
		displaydata(data);
	}

	console.log("This is test.js");
  	xhr.open('post','get_file_details2.php');
	xhr.send();



    var displaydata  = function(data){

    	var upload = document.getElementById('list_container'),
			//file_name = document.getElementById('file_name'),
    		//file_date = document.getElementById('date'),
    		anchor,
    		filed,
    		x,
    		arr;

    	for(x= 0;x<data.length;x=x+1){
			filed = data[x];
			arr = filed.split('#');
			//$(file_name).text(arr[0]);
			//$(date).text(arr[1]);
			anchor1 = document.createElement('div');
			anchor2 = document.createElement('div');
			anchor3 = document.createElement('div');
				img = document.createElement('img');
			anchor4 = document.createElement('div');
				para = document.createElement('p');
			anchor5 = document.createElement('div');
			anchor6 = document.createElement('div');
				para_owner = document.createElement('p');
			anchor7 = document.createElement('div');
				para_date = document.createElement('p');
			
			anchor1.setAttribute('class','file_list');
			anchor1.setAttribute('id',x.toString());
			anchor1.setAttribute('data-id',x.toString());  // setting data-id to identify the list
			anchor1.setAttribute('file-id',arr[3]);
			anchor2.setAttribute('class','icon_name');
			anchor3.setAttribute('class','div_4');
				img.setAttribute('class','imageForFileList');
				$(img).attr("src","images/file_icon4.png");
			anchor4.setAttribute('class','div_5');
				$(para).text(arr[0]);
				para.setAttribute('id','para'+ x.toString());
			anchor5.setAttribute('class','file_description');
			anchor6.setAttribute('class','div_7');
				$(para_owner).text(arr[2]);
				para_owner.setAttribute('id','para_owner'+x.toString());
			anchor7.setAttribute('class','div_8');
				$(para_date).text(arr[1]);

				
			upload.appendChild(anchor1);
			anchor1.appendChild(anchor5);
			anchor1.appendChild(anchor2);
			anchor2.appendChild(anchor3);
				anchor3.appendChild(img);
			anchor2.appendChild(anchor4);
				anchor4.appendChild(para);
			anchor5.appendChild(anchor7);
				anchor7.appendChild(para_date);
			anchor5.appendChild(anchor6);
				anchor6.appendChild(para_owner);
		}



		//calls the updown.js from here(if its called from html, because of its asynchronous property it will get called before ajax load php and return my value)

    	$.getScript('assets/scripts/updown.js', function()
		{
		    // script is now loaded and executed.
		    // put your dependent JS here.
		});

    	$.getScript('assets/scripts/customized_menu.js', function()
		{
		    // script is now loaded and executed.
		    // put your dependent JS here.
		});

		$.getScript('assets/scripts/upload.js', function()
		{
			//location.reload();
		    // script is now loaded and executed.
		    // put your dependent JS here.
		});
    }

    
});

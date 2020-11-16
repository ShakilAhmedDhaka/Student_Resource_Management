(function(){
		//console.log('Test.');
		var dropzone = document.getElementById('dropzone');
		var cnt = 1;
		
		var displayUpload  = function(data){
			var upload = document.getElementById('upload'),
					anchor,
					x;
			for(x= 0;x<data.length;x=x+1){
				anchor = document.createElement('a');
				anchor.href = data[x].file;
				console.log( data[x].file);
				anchor.innerText = data[x].name;
				upload.appendChild(anchor);
				
			}

			location.reload();
		}


		var upload = function(files){
			console.log(files);
			var formData = new FormData();
			var	xhr = new XMLHttpRequest();
			var	x;

			for(x=0;x<files.length;x=x+1){
				formData.append('file[]',files[x]);
			}

			xhr.onload = function(){
				console.log("returned from upload.php");
				var data = JSON.parse(xhr.responseText);
				console.log(data);
				displayUpload(data);
			}

			xhr.open('post','upload.php');
			xhr.send(formData);


			xhr.onreadystatechange = function(){
				if(xhr.readyState != 4) return;
				if(xhr.status==200){
					console.log("successful");
				    /*var data = xhr.responseText;
				    console.log(data);
				    console.log(data[0].file);*/
				}
				else{
					console.log("unsuccessfull"+cnt);
					console.log(xhr.statusText);
					cnt = cnt+1;
				}
			}
		}


		dropzone.ondrop = function(e){
			console.log("in ondrop function");
			e.preventDefault();
			this.className = 'dropzone';
			console.log(e.dataTransfer.files);
			upload(e.dataTransfer.files);
		};

		dropzone.ondragover = function(){
			this.className = 'dropzone dragover';
			return false;
		};

		dropzone.ondragleave = function(){
			this.className = 'dropzone';
			return false;
		};
	}());
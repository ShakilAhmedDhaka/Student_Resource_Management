(function(){
		//console.log('Test.');
		var dropzone = document.getElementById('dropzone');
		
		
		var displayUpload  = function(data){
			var upload = document.getElementById('pro_pic'),
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


		var upload = function(files){
			console.log(files);
			var formData = new FormData();
			var	xhr = new XMLHttpRequest();
			var	x;

			for(x=0;x<files.length;x=x+1){
				formData.append('file[]',files[x]);
			}

			xhr.onload = function(){
				var data = JSON.parse(this.responseText);
				console.log(data);

				displayUpload(data);
			}

			xhr.open('post','upload.php');
			xhr.send(formData);
		}


		dropzone.ondrop = function(e){
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
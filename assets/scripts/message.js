$(function () {
    $(".img_name_container").mousedown(function(event) {
    	 $('.img_name_container').css("background-color","#F6F6F6");
    	 switch (event.which) {
    	 	case 1:
	            $(this).css('background-color', '#41C0FF');
	            break;
	        case 2:
	            //alert('Middle Mouse button pressed.');
	            break;
	        case 3:
	            //$(this).css('background-color', '#33CC33');
	            $(this).css('background-color', '#41C0FF');
	            break;
	        default:
	            //alert('You have a strange Mouse!');
    	 }
        //$(this).css('background-color', '#41C0FF');
    });

});


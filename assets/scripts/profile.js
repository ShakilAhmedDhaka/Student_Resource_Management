$(document).ready(function(){
	var scrolled = 0;


	$("a").click(function () {
		

		if( $(this).attr('class') == "icon-phone" ){

			close_rest();
			$('#phone_no').css('display', 'none');
			$('#para1').css('display', 'block');
		}

		if( $(this).attr('class') == "icon-map-marker" ){

			close_rest();
			$('#address').css('display', 'none');
			$('#para2').css('display', 'block');
		}

		if( $(this).attr('class') == "icon-facebook" ){

			close_rest();
			$('#facebook').css('display', 'none');
			$('#para3').css('display', 'block');
		}

		if( $(this).attr('class') == "icon-twitter" ){

			close_rest();
			$('#twitter').css('display', 'none');
			$('#para4').css('display', 'block');
		}

		if( $(this).attr('class') == "icon-globe" ){

			close_rest();
			$('#website').css('display', 'none');
			$('#para5').css('display', 'block');
		}


		
		//document.getElementById("#para").style.display = "block";
/*		scrolled = scrolled+2000;

		// Set the effect type
	    var effect = 'slide';
	    
	    // Set the duration (default: 400 milliseconds)
	    var duration = 1500;

	    // Set the options for the effect type chosen
	    var options = { direction: "down" };
		$('#para').toggle(effect, options, duration);
		//var options = { direction: "right" };
		//$('button[name = btn2]').toggle(effect, options, duration);
		$("body").animate({
				        scrollTop:  scrolled
				   });
*/
	});





	$(".edit_button").click(function () {

		if( $(this).attr('id') == "submit_phone" ){
			$('#submit_phone').css('background-color', 'red');

			/*var bla = $('#edit_phone').val();
			$('#phone_no').text(bla);

			$('#para').css('display', 'none');
			$('#phone_no').css('display', 'block');*/

			//return false;
		}

	});

	$('.hidden_edits').submit(function(e){
		//e.preventDefault();
		

		//return false;
	});


	$("p").hover(function(){
/*        $(this).css("background-color", "yellow");
        }, function(){
        $(this).css("background-color", "pink");*/
    });


    $(document).keyup(function(e) {
	     if (e.keyCode == 27) { // escape key maps to keycode `27`
	        close_rest();
	    }
	});



    function close_rest(){
		$('#phone_no').css('display', 'block');
		$('#para1').css('display', 'none');

		$('#address').css('display', 'block');
		$('#para2').css('display', 'none');

		$('#facebook').css('display', 'block');
		$('#para3').css('display', 'none');

		$('#twitter').css('display', 'block');
		$('#para4').css('display', 'none');

		$('#website').css('display', 'block');
		$('#para5').css('display', 'none');
		}


});

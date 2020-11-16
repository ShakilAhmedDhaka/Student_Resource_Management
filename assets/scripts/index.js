$(document).ready(function(){
	var scrolled = 0;


	$("button[name=btn2]").click(function () {
		scrolled = scrolled+2000;

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

	});


});

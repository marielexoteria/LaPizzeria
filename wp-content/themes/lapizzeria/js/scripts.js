$ = jQuery.noConflict(); //so that there's no "TypeError: $ is not a function" error on the console. This happens with $(document).ready().

$(document).ready(function() {
	$('.mobile-menu a').on('click', function() {
		/* shows the menu when a user clicks on the hamburger menu button. If the menu is shown and the user clicks on the hamburger menu
		then the menu will hide
		*/
		$('nav.site-nav').toggle('slow'); 
	});
	
	//show the mobile menu
	var breakpoint = 768;
	$(window).resize(function() {
		if ($(document).width() >= breakpoint) {
			$('nav.site-nav').show(); //shows the desktop version of the main menu when the screen size is 768px or more
		} else {
			$('nav.site-nav').hide(); //hides the desktop version of the main menu when the screen size is up to 767px
		}
	});
	
	//boxAdjustment(); // when did we write this function???
	
	//fluidbox plugin
	jQuery('.gallery a').each(function() {
		jQuery(this).attr({'data-fluidbox': ''});
	});
	
	if (jQuery('[data-fluidbox]').length > 0) {
		jQuery('[data-fluidbox]').fluidbox();
	}
	
});

//adapts the height of the images to the div elements - when did we write this function???
/*function boxAdjustment() {
	var images = $('.box-image');
	if (images.length > 0) {
		var imageHeight = images[0].height;
		var boxes = $('.content-box');
		$(boxes).each(function(i, element) {
			$(element).css({'height': imageHeight +'px'});
		});
	}
}*/


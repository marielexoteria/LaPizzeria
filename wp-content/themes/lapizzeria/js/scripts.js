$ = jQuery.noConflict(); //so that there's no "TypeError: $ is not a function" error on the console. This happens with $(document).ready().

$(document).ready(function() {
	$('.mobile-menu a').on('click', function() {
		/*shows the menu when a user clicks on the hamburger menu button. If the menu is shown and the user clicks on the hamburger menu
		then the menu will hide
		*/
		$('nav.site-nav').toggle('slow'); 
	});
	
	var breakpoint = 768;
	$(window).resize(function() {
		if ($(document).width() >= breakpoint) {
			$('nav.site-nav').show(); //shows the desktop version of the main menu when the screen size is 768px or more
		} else {
			$('nav.site-nav').hide(); //hides the desktop version of the main menu when the screen size is up to 767px
		}
	});
	
});



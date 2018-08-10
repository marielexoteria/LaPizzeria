var map;
function initMap() {
	var latLng = {
		lat: parseFloat(options.latitude),
		lng: parseFloat(options.longitude)
	}; //parseFloat para convertir los strings que se introdujeron en el backend de WP a números con puntos decimales
    map = new google.maps.Map(document.getElementById('map'), {
        center: latLng,
        zoom: parseInt(options.zoom)
    }); //parseInt para convertir el string que se introdujeron en el backend de WP a un número entero
	
	var marker = new google.maps.Marker({
		position: latLng,
		map: map,
		title: 'La Pizzeria'
	}); //map: map = map as in Google Map and map as in the variable declared above
}

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
		//boxAdjustment();
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
	
	//adapting the map to the height of the container
	var map = $('#map');
	if (map.length > 0) {
		if ($(document).width() >= breakpoint) { //breakpoint as defined above (show the mobile menu)
			displayMap(0);
		} else {
			displayMap(300);
		}
	}
	$(window).resize(function() { //needed to track whether the window is resized or not (otherwise it won't display the map at 300px in small screens)
		if ($(document).width() >= breakpoint) {
			displayMap(0);
		} else {
			displayMap(300);
		}
	});
	
	
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

function displayMap(value) {
	if (value == 0) {
		var locationSection = $('.location-reservation');
		var locationHeight = locationSection.height();
		$('#map').css({'height': locationHeight});
	} else {
		$('#map').css({'height': value});
	}
}


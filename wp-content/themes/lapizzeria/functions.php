<?php
	//This file contains all the functionality related to the theme
	/* Good idea: to name the functions in the format <theme name>_<name of the function>. This way the functions created won't interfere
	   with similar names found in plugins or with "reserved names" (names that cannot be used because PHP/WP already use them)
	*/
	 
	//Link or import the inc/reservations_database.php file (this contains the SQL structure)
	require get_template_directory() . '/inc/reservations_database.php';
	
	//Link or import the inc/reservations.php file (this handles the submissions to the table created in reservations_database.php)
	require get_template_directory() . '/inc/reservations.php';
	
	//To include files in the backend of WP (so that they show on the same menu as Pages, Posts, etc.)
	require get_template_directory() . '/inc/options.php';
	
	//To enable having the "add featured image" option on pages
	function lapizzeria_setup() {
		add_theme_support('post-thumbnails');
		
		/* to set a default image size to the key "boxes". https://developer.wordpress.org/reference/functions/add_image_size/ - this function is used together with the plugin "Regenerate thumbnails"
		   because in the course the images on page-about-us.php were added before declaring the image size. While it's possible to delete the 3 images and reload them again, this is not practical when a theme
		   has a large number of images. 
		*/
		add_image_size('boxes', 437, 299, true); 
		add_image_size('specialties', 768, 515, true);
		add_image_size('specialty-portrait', 435, 530, true);
		
		update_option('thumbnail_size_w', 253); //w = width; https://codex.wordpress.org/Function_Reference/update_option
		update_option('thumbnail_size_h', 164); //h = height
	}

	//The function will run in the hook "after_setup_theme"
	add_action('after_setup_theme', 'lapizzeria_setup');
	
	function lapizzeria_styles() {
		//Will add the stylesheet
		
		/* registers the CSS file for later use. See codex: https://codex.wordpress.org/Function_Reference/wp_register_style
		   first parameter 'style' = the name of the stylesheet 
		   second parameter '' = the path of the stylesheet. Instead of hard-coding the path where the stylesheet is, 
		   get_template_directory_uri() will get it automatically and all we need to provide is '/style,.css'
		   array() = array of dependencies. for ex. if using Bootstrap, it needs to have add normalize.css first
		   1.0 = version of the stylesheet
		*/
		wp_register_style('googlefont', 'https://fonts.googleapis.com/css?family=Open+Sans:400,700|Raleway:400,700,900', array(), '1.0.0'); //linking to Google fonts Open Sans and Raleway
		wp_register_style('normalize', get_template_directory_uri() . '/css/normalize.css', array(), '8.0.0' ); //adding normalize.css, which allows for html components to look and act the same across different browsers (https://necolas.github.io/normalize.css/)
		wp_register_style('fluidboxcss', get_template_directory_uri() . '/css/fluidbox.min.css', array(), '1.0.0' ); //adding fluidbox.min.css, which is needed in the gallery
		wp_register_style('fontawesome', get_template_directory_uri() . '/css/font-awesome.css', array('normalize'), '4.7.0'); //font awesome (for the icons)
		wp_register_style('datetime-local', get_template_directory_uri() . '/css/datetime-local-polyfill.css', array('normalize'), '1.0.0');  //polyfill because FF doesn't support datetime-local and there's no calendar picker on the reservation form
		wp_register_style('style', get_template_directory_uri() . '/style.css', array('normalize'), '1.0'); //main stylesheet
		
		
		//Enqueues the style. Must use after using wp_register_style()
		wp_enqueue_style('normalize');
		wp_enqueue_style('fluidboxcss');
		wp_enqueue_style('fontawesome');
		wp_enqueue_style('googlefont');
		wp_enqueue_style('datetime-local');
		wp_enqueue_style('style'); //file for the custom CSS code
		
		
		//Adding the jQuery library files
		/* jQuery is installed by default when installing WP. The library is in wp-includes/js/jquery
		   https://developer.wordpress.org/reference/functions/wp_enqueue_script/#default-scripts-included-and-registered-by-wordpress 
		*/
		wp_register_script('fluidboxjs', get_template_directory_uri() . '/js/jquery.fluidbox.min.js', array('jquery'), '1.0.0', true); //true = load the js in the before closing the HTML body tag (footer.php)
		wp_register_script('debounce', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-throttle-debounce/1.1/jquery.ba-throttle-debounce.min.js', array(), '', true); //needed for fluidbox to work
		wp_register_script('datetime-local-polyfill', get_template_directory_uri() . '/js/datetime-local-polyfill.js', array('jquery', 'jquery-ui-core', 'jquery-ui-datepicker', 'modernizr'), '', true); //adding the js needed for the polyfill to work (so that there's a calendar picker on the reservations form on FF)
		wp_register_script('modernizr', 'https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js', array('jquery'), '', true); //needed for the polyfill to work
		wp_register_script('script', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0.0', true);
		
		//Adding the script needed to embed the Google Maps to the front page
		$apiKey = esc_html(get_option('lapizzeria_gmap_api_key'));
		wp_register_script('googlemaps', 'https://maps.googleapis.com/maps/api/js?key='.$apiKey.'&callback=initMap', array(), '2.8.3', true); //needed to load the Google Maps API 
		/* needed to be able to load the map with no probs: enable both the Maps Javascript API and the Geocoding API, solution from 
	       https://stackoverflow.com/questions/38199452/google-maps-api-deletedapiprojectmaperror
		   using the API Key as specified above from La Pizzeria WP Theme ENG
		*/
		
		
		//Enqueues the Javascript files
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-core'); //jQuery UI comes by default in WP and is needed for the polyfill to work (so that there's a calendar picker on the reservations form on FF)
		wp_enqueue_script('jquery-ui-datepicker'); //jQuery UI comes by default in WP and is needed for the polyfill to work (so that there's a calendar picker on the reservations form on FF)
		wp_enqueue_script('datetime-local-polyfill'); 
		wp_enqueue_script('debounce'); //needed for fluidbox to work
		wp_enqueue_script('fluidboxjs');
		wp_enqueue_script('modernizr');
		wp_enqueue_script('script'); //file for custom scripts
		wp_enqueue_script('googlemaps'); /* needs to be last because otherwise it gives an error of initMap (function used in scripts.js) not being a function. Solution from https://www.udemy.com/photoshop-psd-to-wordpress-theme-development-from-scratch/learn/v4/questions/2306654 */
		
		wp_localize_script(
			'script',
			'options',
			array(
				'latitude' => esc_html(get_option('lapizzeria_gmap_latitude')),
				'longitude' => esc_html(get_option('lapizzeria_gmap_longitude')),
				'zoom' => esc_html(get_option('lapizzeria_gmap_zoom_level'))
			)
		);
		/* script = the name of the JS file to pass info to
		   options = the object that will take the info to pass to the array from inc > options.php
		   latitu
		*/
		
	}
	
	/* WP hook the functions created. 
	   Needs the function wp_head() in header.php to implement the stylesheet on the WP theme
	*/
	add_action('wp_enqueue_scripts', 'lapizzeria_styles');
	
	//Adding nav and social media menus
	function lapizzeria_menus() {
		//using an associative array using a key value parse
		/* the keys of the array are named by me (first parameter). The second parameter is a more readable version of the first parameter, 
		   and the third parameter is the text domain (optional)
		*/
		register_nav_menus(
			array(
				'header-menu' => __('Header Menu', 'lapizzeria'),
				'social-menu' => __('Social Menu', 'lapizzeria')
			) 
		);	
	}
	
	//init is a hook that runs when WP initializes
	add_action('init', 'lapizzeria_menus');
	
	
	//Adding the specialties (pizzas, pasta and other items the place offers)
	function lapizzeria_specialties() {
		$labels = array(
			'name'               => __( 'Pizzas', 'lapizzeria' ),
			'singular_name'      => __( 'Pizza', 'post type singular name', 'lapizzeria' ),
			'menu_name'          => __( 'Pizzas', 'admin menu', 'lapizzeria' ),
			'name_admin_bar'     => __( 'Pizzas', 'add new on admin bar', 'lapizzeria' ),
			'add_new'            => __( 'Add New', 'book', 'lapizzeria' ),
			'add_new_item'       => __( 'Add New Pizza', 'lapizzeria' ),
			'new_item'           => __( 'New Pizzas', 'lapizzeria' ),
			'edit_item'          => __( 'Edit Pizzas', 'lapizzeria' ),
			'view_item'          => __( 'View Pizzas', 'lapizzeria' ),
			'all_items'          => __( 'All Pizzas', 'lapizzeria' ),
			'search_items'       => __( 'Search Pizzas', 'lapizzeria' ),
			'parent_item_colon'  => __( 'Parent Pizzas:', 'lapizzeria' ),
			'not_found'          => __( 'No Pizzas found.', 'lapizzeria' ),
			'not_found_in_trash' => __( 'No Pizzas found in Trash.', 'lapizzeria' )
		);
		/* The array() in $labels and $args is a default for WP.
		   menu_name = the name of the menu that will be printed in the WP console, in the left hand bar with Posts, Pages, etc.
		   menu_admin_bar = the name that will be printed in the admin bar, under "+ New", together with View Page, etc.
		*/
		
		$args = array(
			'labels'             => $labels,
			'description'        => __( 'Description.', 'lapizzeria' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'specialties' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => 6,
			'supports'           => array( 'title', 'editor', 'thumbnail' ),
			'taxonomies'          => array( 'category' ),
		);
		/* show_ui = the most important section, will enable seeing the options declared in $labels in the WP console
		   editor (in supports) = the main editor in WP
		*/

		register_post_type( 'specialties', $args );
	}

	add_action( 'init', 'lapizzeria_specialties' );
	
	//Adding the widget zone. It will create a space to drag existing widgets to
	function lapizzeria_widgets() {
		register_sidebar( array( //to add the widgets, even tho the function is called sidebar
			'name' => 'Blog sidebar', //the name that will be printed in the WP console/backend
			'id' => 'blog_sidebar',
			'before_widget'=> '<div class="widget">', //the info that will be printed before the widget
			'after_widget' => '</div>', //the info that will be printed after the widget
			'before_title' => '<h3>', //the tag that will print the title
			'after_title' => '</h3>')
		); 
		
	}
	
	add_action('widgets_init', 'lapizzeria_widgets');
	
	/* Workaround for the issue that when one clicks on any of the specialties, the Blog in the nav menu gets also highlighted, and if I remove the line 
	   "nav.site-nav ul li.current_page_parent a" from the CSS then the Blog (nav menu) doesn't get highlighted if one clicks on any blog entry. From
	   https://www.udemy.com/photoshop-psd-to-wordpress-theme-development-from-scratch/learn/v4/questions/4150414
	*/
	function remove_page_parent_post_tye($classes, $item) {
		if ((is_post_type_archive('specialties') || is_singular('specialties'))  && $item->title == 'Blog') {
			$classes = array_diff( $classes, array( 'current_page_parent' ) );
		}
		return $classes;
    }
	
    add_filter( 'nav_menu_css_class', 'remove_page_parent_post_tye', 10, 2 ); //this function needs the space before the 'nav_menu_css_class' or else it will give an error
	
	function add_async_defer($tag, $handle) { //because the Google Maps library requires it to load the map. Made in lecture 112
		if ('googlemaps' !== $handle) {
			return $tag;
		}
		return str_replace(' src', ' async="async" defer="defer" src', $tag);
	}
	
	add_filter( 'script_loader_tag', 'add_async_defer', 10, 2); //this function needs the space before the 'script_loader_tag' or else it will give an error
	/*
		script_loader_tag = the hook that will connect the function
		add_async_defer = the function to connect
		10 = the priority
		2 = the number of arguments
	*/
	

?>
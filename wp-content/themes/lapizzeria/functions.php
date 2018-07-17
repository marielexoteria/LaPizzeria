<?php
	//This file contains all the functionality related to the theme
	/* Good idea: to name the functions in the format <theme name>_<name of the function>. This way the functions created won't interfere
	   with similar names found in plugins or with "reserved names" (names that cannot be used because PHP/WP already use them)
	*/
	
	//To enable having the "add featured image" option on pages
	function lapizzeria_setup() {
		add_theme_support('post-thumbnails');
		
		/* to set a default image size to the key "boxes". https://developer.wordpress.org/reference/functions/add_image_size/ - this function is used together with the plugin "Regenerate thumbnails"
		   because in the course the images on page-about-us.php were added before declaring the image size. While it's possible to delete the 3 images and reload them again, this is not practical when a theme
		   has a large number of images. 
		*/
		add_image_size('boxes', 437, 299, true); 
		add_image_size('specialties', 768, 515, true);
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
		wp_register_style('fontawesome', get_template_directory_uri() . '/css/font-awesome.css', array('normalize'), '4.7.0'); //font awesome (for the icons)
		wp_register_style('style', get_template_directory_uri() . '/style.css', array('normalize'), '1.0'); //main stylesheet
		
		
		//Enqueues the style. Must use after using wp_register_style()
		wp_enqueue_style('normalize');
		wp_enqueue_style('fontawesome');
		wp_enqueue_style('googlefont');
		wp_enqueue_style('style');
		
		
		//Adding the jQuery library files
		/* jQuery is installed by default when installing WP. The library is in wp-includes/js/jquery
		   https://developer.wordpress.org/reference/functions/wp_enqueue_script/#default-scripts-included-and-registered-by-wordpress 
		*/
		wp_register_script('script', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0.0', true); //true = load the js in the before closing the HTML body tag (footer.php)
		wp_enqueue_script('jquery');
		wp_enqueue_script('script'); //file for custom scripts
		
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

?>
<?php 
	/* function that gets or includes header.php
	This file is at the beginning of the course in the same folder as page.php
	*/
	get_header();
?>
    <!--Front page of a website, which can be optional since there's also a home.php file according to
	  the template hierarchy: https://developer.wordpress.org/files/2014/10/template-hierarchy.png, but
	  If front-page.php exists, WP will automatically use it instead of home.php (even tho we set that the
	static page that would be the home page is home -> settings > reading > static page > homepage + posts page -->
	<h1>Hello from front-page.php</h1>
		  
<?php 
	/* function that gets or includes footer.php
	This file is at the beginning of the course in the same folder as page.php
	*/
	get_footer();
?>
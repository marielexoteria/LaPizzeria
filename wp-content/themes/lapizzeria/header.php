<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>La Pizzeria</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- code to make the website iOS compatible -->
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-title" content="La Pizzeria Restaurant">
	<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri()?>/apple-touch-icon.jpg">
	
	<!-- code to make the website Android compatible -->
	<meta name="theme-color" content="#a61206">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="application-name" content="La Pizzeria Restaurant">
	<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri()?>/icon.png" sizes="192x192">
	
    <?php 
		/* Needed to add the stylesheet to the WP theme, together with the code 
		   included in the function lapizzeria_styles() in functions.php  
		*/
		wp_head();
	?>
  </head>
  <body <?php body_class(); //this function will print different classes that can be used to target an element in the CSS. It shows different classes in different pages, according to
   //what is been used. The printed classes are those used by WP, so it's a good idea to use this function and avoid making more classes. ?>>
		<header class="site-header">
			<div class="container">
				<div class="logo">
					<!-- The WP function esc_url() removes dangerous or invalid characters from URLs and thus sanitizes data (https://codex.wordpress.org/Function_Reference/esc_url)
					     home_url() gets the path of the URL that makes the home of the site (https://codex.wordpress.org/Function_Reference/home_url) -->
					<a href="<?php echo esc_url(home_url('/')); ?>">
						<!-- Using the WP function get_template_directory_uri we get the path where the folder 
						     that contains the logo is, and all we need to do is add the sub-folder and file name -->
						<img src="<?php echo get_template_directory_uri(); ?>/img/logo.svg" class="logoimage" alt="Logo" style="">
					</a>
				</div> <!-- ./logo -->
					
				<!-- social media icons + contact info -->
				<div class="header-information">
					<div class="socials">
						<?php 
							/* theme_location will tell WP which menu we want to print
							   container = HTML element that will house the menu
							   contailer_class = (CSS) class to apply to the container element specified in the second key of the array
							   container_id = (CSS) id to apply to the container element specified in the second key of the array
							   link_before = opens a span tag (or whatever other HTML tag) for each menu item (sr = screen reader - devices for visually impaired users)
							   link_after = closes the span tag specified in link_before
							   end result: (using Facebook as an example but there are 5 diff social media specified in the menu in WP)
								<nav id="socials" class="socials">
									<ul id="menu_social_menu" class="menu">
										<li id="menu-item-23" class="menu-item menu-item-type-custom menu-item-obejct-custom menu-item-23>
											<a href="http://www.facebook.com">
												<span class="sr-text">Facebook</span>
											</a>
										</li>
									</ul>
								</nav>
							*/
							$args = array(
								'theme_location'  => 'social-menu', 
								'container'       => 'nav',
								'container_class' => 'socials',
								'container_id' 	  => 'socials',
								'link_before'     => '<span class="sr-text">',
								'link_after'      => '</span>'
							);
							//displays a navigation menu (https://developer.wordpress.org/reference/functions/wp_nav_menu/)
							wp_nav_menu($args);
						?>
					</div> <!-- ./socials -->
						
					<div class="address">
						<p><?php echo esc_html(get_option('lapizzeria_address'));?></p>
						<p>Phone Number: <?php echo esc_html(get_option('lapizzeria_phone_number'));?></p>
					</div> <!-- ./address -->
				</div> <!-- ./header-information -->
			</div> <!-- ./container -->
		</header>
		
		<div class="main-menu">
			<div class="mobile-menu">
				<a href="#" class="mobile"><i class="fa fa-bars"></i> Menu</a>
			</div> <!-- ./mobile-menu -->
		
			<div class="navigation container">
				<?php 
					/* theme_location will tell WP which menu we want to print
					   container = HTML element that will house the menu
					   contailer_class = class to apply to the container element specified in the second key of the array
					   end result: <nav class="site-nav">
					*/
					$args = array(
						'theme_location'  => 'header-menu', 
						'container'       => 'nav',
						'container_class' => 'site-nav'
					
					);
					//displays a navigation menu (https://developer.wordpress.org/reference/functions/wp_nav_menu/)
					wp_nav_menu($args);
				?>
			</div> <!-- ./navigation container -->
		</div> <!-- ./main-menu -->

<?php 
	/* function that gets or includes header.php
	   This file is at the beginning of the course in the same folder as page.php
	*/
	get_header();
?>

<?php
	/* Front page of a website, which can be optional since there's also a home.php file according to
	     the template hierarchy: https://developer.wordpress.org/files/2014/10/template-hierarchy.png, but
	     If front-page.php exists, WP will automatically use it instead of home.php (even tho we set that the
	     static page that would be the home page is home -> settings > reading > static page > homepage + posts page */
		 
	//have_posts() is a WP function that checks that a page has content (text, images, etc.)
	while(have_posts()): the_post(); //simplified version of a while loop. While there's content to display, it will do so
?>
	<div class="hero" style="background-image:url(<?php echo get_the_post_thumbnail_url(); ?>);"> <!-- displaying the featured image as background. get_the_post_thumbnail() will return the url of the thumbnail and render it on
	//the browser without an <img> tag, which the_post_thumbnail() does -->
		<div class="hero-content">
			<div class="hero-text">
				<h2>
					<?php echo esc_html(get_option('blogdescription')); //prints the tagline of the page as defined in Settings > General ?>
				</h2>
				<?php 
					the_content(); 
					$url = get_page_by_title('About Us');
				?>
				<a class="button secondary" href="<?php echo get_permalink($url->ID); ?>">More info</a>
			</div> <!-- ./hero-text -->
		</div> <!-- ./hero-content -->
	</div> <!-- ./hero -->
	<?php endwhile; //ends the while loop ?> 
	
	<div class="main-content container">
		<main class="container-grid clear">
			<h2 class="text-center primary-text" >Our Specialties</h2>
			<?php
				$args = array(
					'posts_per_page' => 3,
					'post_type' => 'specialties',
					'category_name' => 'pizzas',
					'orderby' => 'rand'
				); 
				/* Content of the array:
					posts_per_page = the # of posts to display
					post_type = what was registered in functions.php 
					category_name = showing only the pizzas as per the design
					orderby rand = so that the page show 3 different pizzas whenever a user visits the page; not to be used in pages with a lot of traffic because it uses a lot of memory
				*/
				$specialties = new WP_Query($args);
				while ($specialties->have_posts()) : $specialties->the_post();
			?>
				<div class="specialty columns1-3">
					<div class="specialty-content">
						<?php the_post_thumbnail('specialty-portrait'); ?>
						<div class="information">
							<?php 
								the_title('<h3>', '</h3>'); 
								the_content();
							?>
							<p class="price">$<?php the_field('price'); ?></p>
							<a class="button primary" href="<?php the_permalink(); ?>">Read more</a>
						</div> <!-- ./information -->
					</div> <!-- ./specialty-content -->
				</div> <!-- ./specialty columns1-3 -->
			<?php
				
				endwhile;
				wp_reset_postdata();
			?>
		</main>
	</div> <!-- ./main-content container -->

	<section class="fresh-ingredients">
		<div class="container">
			<div class="container-grid">
				<?php while (have_posts()) : the_post(); ?>
				<div class="columns2-4">
					<h3><?php the_field('ingredients_title'); ?></h3>
					<?php 
						the_field('ingredients_text'); 
						$url = get_page_by_title('About Us');
					?>
					<a class="button primary" href="<?php echo get_permalink($url->ID); ?>">Read more</a>
				</div> <!-- ./columns2-4 left -->
				
				<div class="columns2-4 image">
					<img src="<?php the_field('ingredients_image'); ?>" alt="fresh ingredients">
				</div> <!-- ./columns2-4 right -->
				<?php
					endwhile;
				?>
			</div> <!-- ./container-grid -->
		</div> <!-- ./container -->
	</section>
	
	<section class="container clear"> <!-- usando la clase clear porque las fotos de la galería tienen un float left y para que la info del footer no se muestre al lado de la galería -->
		<h2 class="primary-text text-center">Gallery</h2>
		<?php
			//Querying the content in the page "Gallery" to display it here
			$url = get_page_by_title('Gallery'); //returns the ID of the page given
			echo get_post_gallery($url->ID); //WP function that will retrieve a gallery
		?>
	</section>
	
	<section class="container location-reservation clear">
		<div class="container-grid">
			<div class="columns2-4">
				<div id="map">
					Map goes here
				</div> <!-- #/map -->
			</div> <!-- ./columns2-4 map -->
			
			<div class="columns2-4">
				<?php get_template_part('templates/reservation', 'form');
				/* WP function to get the content of a custom file, in this case the reservation form, because it will be used in the front page and the contact us page;
			       the name of the file is split as shown above, usually by the dash (the file is called reservation-form.php) */?>
			</div> <!-- ./columns2-4 reservations form-->
		</div> <!-- ./container-grid -->
	</section>

<?php 
	/* function that gets or includes footer.php
	   This file is at the beginning of the course in the same folder as page.php
	*/
	get_footer();
?>
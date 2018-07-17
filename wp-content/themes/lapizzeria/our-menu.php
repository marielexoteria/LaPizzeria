<?php 
	/* Extra info for WP since this is a page made as a $custom.php page (see template hierarchy: https://developer.wordpress.org/files/2014/10/wp-hierarchy.png).
	   Agrega la posibilidad de elegir un template en WP (Edit page > Page attributes > Template)
	   Template name: Our specialties.
	   *** Para que la página despliegue el menú, la page en el WP console debe tener el template "Our specialties" ***
	*/
	
	
	/* function that gets or includes header.php
	This file is at the beginning of the course in the same folder as page.php
	*/
	get_header();
?>

<?php
	//have_posts() is a WP function that checks that a page has content (text, images, etc.)
	while(have_posts()): the_post(); //simplified version of a while loop. While there's content to display, it will do so
?>
	<div class="hero" style="background-image:url(<?php echo get_the_post_thumbnail_url(); ?>);"> <!-- displaying the featured image as background. get_the_post_thumbnail() will return the url of the thumbnail and render it on
	//the browser without an <img> tag, which the_post_thumbnail() does -->
		<div class="hero-content">
			<div class="hero-text">
				<h2><?php the_title(); //prints the title of the page ?></h2>
			</div>
		</div>
	</div>
	
	<div class="main-content container">
		<main class="text-center content-text">
			<?php the_content(); //prints the content of the page ?> 
		</main>
	</div>

<?php endwhile; //ends the while loop ?> 

<div class="our-specialties container">
	<h3 class="primary-text">Pizzas</h3>
	<div class="container-grid">
		<?php
			$args = array(
				'post_type' => 'specialties',
				'posts_per_page' => 10,
				'orderby' => 'title',
				'order' => 'ASC',
				'category_name' => 'pizzas'
			);
			/* post_type = 'specialties' comes from the line "register_post_type()" on function lapizzeria_specialties()
			   post_per_page = number of posts to return (show on this page)
			   category_name = the slug of the category
			*/
			$pizzas = new WP_Query($args); //makes a custom Wordpress query passing the arguments defined in $args
			
			while($pizzas->have_posts() ): $pizzas->the_post(); //"->" is used to access the contents of an object?>
				<div class="columns2-4 specialty-content">
					<a href="<?php the_permalink(); //will print the link that corresponds to the specialty, created when each dish was added in Wordpress?>">
						<?php the_post_thumbnail('specialties'); //to display the featured image when the pizza or dish was created in Wordpress ?>
						<h4><?php the_title(); ?> <span>$<?php the_field('price'); //the custom field created and that has the price of the dish ?></span></h4>
						<?php the_content(); ?>
					</a>
				</div>
		
		<?php
			endwhile; 
			wp_reset_postdata(); //this function will finish the WP_Query() and will tell Wordpress to continue running in the standard way
		?>
	</div>
	
	<h3 class="primary-text">Others</h3>
	<div class="container-grid">
		<?php
			$args = array(
				'post_type' => 'specialties',
				'posts_per_page' => 10,
				'orderby' => 'title',
				'order' => 'ASC',
				'category_name' => 'others'
			);
			/* post_type = 'specialties' comes from the line "register_post_type()" on function lapizzeria_specialties()
			   post_per_page = number of posts to return (show on this page)
			   category_name = the slug of the category
			*/
			$others = new WP_Query($args); //makes a custom Wordpress query passing the arguments defined in $args
			
			while($others->have_posts() ): $others->the_post(); //"->" is used to access the contents of an object?>
				<div class="columns2-4 specialty-content">
					<a href="<?php the_permalink(); //will print the link that corresponds to the specialty, created when each dish was added in Wordpress?>">
						<?php the_post_thumbnail('specialties'); //to display the featured image when the pizza or dish was created in Wordpress ?>
						<h4><?php the_title(); ?> <span>$<?php the_field('price'); //the custom field created and that has the price of the dish ?></span></h4>
						<?php the_content(); ?>
					</a>
				</div>
		
		<?php
			endwhile; 
			wp_reset_postdata(); //this function will finish the WP_Query() and will tell Wordpress to continue running in the standard way
		?>
	</div>	
	
</div>


<?php 
	/* function that gets or includes footer.php
	 This file is at the beginning of the course in the same folder as page.php
	*/
	get_footer();
?>
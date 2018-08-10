<?php 
	/* Template Name: Contact Us
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
			</div> <!-- ./hero-text -->
		</div> <!-- ./hero-content -->
	</div> <!-- ./hero -->
	
	<div class="main-content container reservation">
		<main class="content-text clear">
			<?php get_template_part('templates/reservation', 'form');
			/* WP function to get the content of a custom file, in this case the reservation form, because it will be used in the front page and the contact us page;
			   the name of the file is split as shown above, usually by the dash (the file is called reservation-form.php) */?>
		</main>
	</div> <!-- ./main-content container reservation -->

<?php endwhile; //ends the while loop ?> 


<?php 
	/* function that gets or includes footer.php
	   This file is at the beginning of the course in the same folder as page.php
	*/
	get_footer();
?>
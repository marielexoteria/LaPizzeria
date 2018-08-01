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
			</div>
		</div>
	</div>
	
	<div class="main-content container reservation">
		<main class="content-text clear">
			<div class="reservation-info">
				<form class="reservation-form" method="post">
					<h2>Make a reservation</h2>
					<div class="field">
						<input type="text" name="name" placeholder="Name" required>
					</div><!-- ./field name -->
					<div class="field">
						<input type="datetime-local" name="date" placeholder="Date" required>
					</div><!-- ./field date -->
					<div class="field">
						<input type="email" name="email" placeholder="E-mail" required>
					</div><!-- ./field e-mail -->
					<div class="field">
						<input type="tel" name="phone" placeholder="Phone number" required>
					</div><!-- ./field phone nr -->
					<div class="field">
						<textarea name="message" placeholder="Message" required></textarea>
					</div><!-- ./textarea -->
					<input type="submit" name="reservation" value="Send" class="button">
					<input type="hidden" name="hidden" value="1">
				</form>
			</div>
		</main>
	</div>

<?php endwhile; //ends the while loop ?> 


<?php 
	/* function that gets or includes footer.php
	   This file is at the beginning of the course in the same folder as page.php
	*/
	get_footer();
?>
<?php 
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

<!-- This content is not added via the About Us page on WP. We added it by installing a plugin that allows the creation of custom fields to add extra content.
     The plugin is called Advanced Custom Fields (by Elliot Condon). I made a new field called About Us, which I placed on the About us page by adding a rule that 
     "page is equal to About us". 

     After the fields are created, then the function the_field() will display their content. -->

<div class="box-information container">
	<div class="single-box">
		<?php 
			$id_image = get_field('image_on_box1'); //get_field() will assign the value (the image ID that we set on the custom fields plugin) to the variable
			$image = wp_get_attachment_image_src($id_image, 'boxes'); //the function will get an image based on an ID and a size - https://developer.wordpress.org/reference/functions/wp_get_attachment_image_src/
		?>
		<image src="<?php echo $image[0]; ?>" alt="image on box 1">
		<div class="content-box">
			<?php echo the_field('description_on_box1');?>
		</div>
	</div> <!-- box with image and text for "original recipes" -->
	<div class="single-box">
		<?php 
			$id_image = get_field('image_on_box2'); //get_field() will assign the value (the image ID that we set on the custom fields plugin) to the variable
			$image = wp_get_attachment_image_src($id_image, 'boxes'); //the function will get an image based on an ID and a size - https://developer.wordpress.org/reference/functions/wp_get_attachment_image_src/
		?>
		<image src="<?php echo $image[0]; ?>" alt="image on box 2">
		<div class="content-box">
			<?php echo the_field('description_on_box2');?>
		</div>
	</div> <!-- box with image and text for "craft beer" -->
	<div class="single-box">
		<?php 
			$id_image = get_field('image_on_box3'); //get_field() will assign the value (the image ID that we set on the custom fields plugin) to the variable
			$image = wp_get_attachment_image_src($id_image, 'boxes'); //the function will get an image based on an ID and a size - https://developer.wordpress.org/reference/functions/wp_get_attachment_image_src/
		?>
		<image src="<?php echo $image[0]; ?>" alt="image on box 2">
		<div class="content-box">
			<?php echo the_field('description_on_box3');?>
		</div>
	</div> <!-- box with image and text for "craft beer" -->
</div>


<?php 
	/* function that gets or includes footer.php
	This file is at the beginning of the course in the same folder as page.php
	*/
	get_footer();
?>
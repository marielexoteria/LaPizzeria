<?php 
	/* function that gets or includes header.php
	   This file is at the beginning of the course in the same folder as page.php
	*/
	get_header();
?>

<?php
	$blog_page = get_option('page_for_posts'); //https://developer.wordpress.org/reference/functions/get_option/ - page_for_posts = ID of the page that displays the blog posts
	$image = get_post_thumbnail_id($blog_page);
	$image_full = wp_get_attachment_image_src($image, 'full'); //en el curso esta variable se llama $image pero le cambié el nombre para diferenciarla; full hace referencia a full size
	
?>

<div class="hero" style="background-image:url(<?php echo $image_full[0]; ?>);"> <!-- displaying the featured image as background. $image_full[0] porque en esta posición del array está el src de la imagen
//the browser without an <img> tag, which the_post_thumbnail() does -->
	<div class="hero-content">
		<div class="hero-text">
			<h2><?php echo get_the_title($blog_page); //retrieves the post title of the ID saved in $blog_page - https://developer.wordpress.org/reference/functions/get_the_title/ ?></h2>
		</div>
	</div>
</div>
	
<div class="main-content container">
	<div class="container-grid">
		<main class="content-text columns2-3">
			<?php
				//have_posts() is a WP function that checks that a page has content (text, images, etc.)
				while(have_posts()): the_post(); //simplified version of a while loop. While there's content to display, it will do so
			?>
				<article class="entry">
					<a href="<?php the_permalink(); //prints the URL for the entry?>">
						<?php the_post_thumbnail('specialties'); //reusing the sizes of the specialties pictures?>
					</a>
					
					<header class="entry-header clear">
						<div class="date">
							<time>
								<?php echo the_time('d'); ?> 
								<span><?php echo the_time('M') ?></span>
							</time>
						</div> <!-- ./date -->
						
						<div class="entry-title">
							<?php the_title('<h2>', '</h2>')?>
							<p class="author">
								<i class="fa fa-user" aria-hidden="true"></i>
								<?php the_author(); ?>
							</p>
						</div> <!-- ./entry-title -->
					</header>
					<div class="entry-content">
						<?php the_excerpt(); ?>
						<a href="<?php the_permalink(); ?>" class="button primary">Read more</a>
					</div> <!-- ./entry-content -->
				</article>
			<?php endwhile; //ends the while loop ?> 
		</main>
		
		<?php get_sidebar(); //to display sidebar.php where widgets usually are placed ?> 
		
	</div>
</div>




<?php 
	/* function that gets or includes footer.php
	   This file is at the beginning of the course in the same folder as page.php
	*/
	get_footer();
?>
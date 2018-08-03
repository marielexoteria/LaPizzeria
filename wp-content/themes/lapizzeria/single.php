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
		<main class="content-text">
			<div class="entry-information clear">
				<div class="date">
					<time>
						<?php echo the_time('d'); ?> 
						<span><?php echo the_time('M') ?></span>
					</time>
				</div> <!-- ./date -->
				<p class="author">
					<i class="fa fa-user" aria-hidden="true"></i>
					<?php the_author(); ?>
				</p>
			</div> <!-- ./entry-information -->
			<?php the_content(); //prints the content of the page ?> 
		</main>
		
		<div class="container comments">
			<?php comment_form(); //prints the comment form ?>
		</div>
		
		<div class="container comment-list">
			<ol class="comments_in_post"> <!-- en el curso: commentlist -->
				<?php
					$comments = get_comments(array( //WP function that retrieves a list of comments - https://codex.wordpress.org/Function_Reference/get_comments
						'post_id' => $post->ID,
						'status' => 'approve'
					)); 
					wp_list_comments(array( //lists the comments indicating how many per page and showing the most recent on top (reverse_top_level = false) - https://codex.wordpress.org/Function_Reference/wp_list_comments
						'per_page' => 10,
						'reverse_top_level' => false
					), $comments);
				?>
			</ol>
		</div>
	</div>

<?php endwhile; //ends the while loop ?> 


<?php 
	/* function that gets or includes footer.php
	   This file is at the beginning of the course in the same folder as page.php
	*/
	get_footer();
?>
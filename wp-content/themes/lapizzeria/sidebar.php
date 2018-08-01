<aside class="columns1-3 sidebar">
	<?php 
		if (is_active_sidebar('blog_sidebar') ) : //checking if the sidebar is active and if so, print the widgets
			dynamic_sidebar('blog_sidebar'); //https://codex.wordpress.org/Function_Reference/dynamic_sidebar 
		endif;
	?>
</aside>
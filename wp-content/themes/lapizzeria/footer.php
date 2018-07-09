	<footer>
		<?php
			//after = prints an element after each item of the menu, which is declared in functions.php > lapizzeria_menus
			$args = array(
				'theme_location' => 'header-menu',
				'container' => 'nav',
				'after' => '<span class="separator"> | </span>'
			);
			
			wp_nav_menu($args);
		?>
		
		<div class="location">
			<p>8179 Bay Avenue Mountain View, CA 94043</p>
			<p>Phone Number: +1-92-456-7890</p>
		</div>
		
		<p class="copyright">All rights reserved <?php echo date('Y'); ?></p>
	</footer>
	
	
	<?php wp_footer(); ?>
  </body>
</html>
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
			<p><?php echo esc_html(get_option('lapizzeria_address'));?></p>
			<p>Phone Number: <?php echo esc_html(get_option('lapizzeria_phone_number'));?></p>
		</div> <!-- ./location -->
		
		<p class="copyright">All rights reserved <?php echo date('Y'); ?></p>
	</footer>
	
	
	<?php wp_footer(); ?>
  </body>
</html>
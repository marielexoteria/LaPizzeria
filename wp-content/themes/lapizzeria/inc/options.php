<?php
	//To include files in the backend of WP (so that they show on the same menu as Pages, Posts, etc.)

	function lapizzeria_options() {
		add_menu_page('La Pizzeria', 'La Pizzeria Options', 'administrator','lapizzeria_options', 'lapizzeria_adjustments', '', 20);
		/* Parameters:
		   La Pizzeria = the title of the page
		   La Pizzeria Options = the title of the menu
		   administrator = which user should see this menu option
		   lapizzeria_options = the slug for the menu
		   lapizzeria_adjustments = the function that will communicate this add menu page
		   '' = if the menu page had an icon, it could be passed here
		   20 = the position (WP counts the positions in 5)
		*/
		
		add_submenu_page('lapizzeria_options', 'Reservations', 'Reservations', 'administrator', 'lapizzeria_reservations', 'lapizzeria_reservations');
		/* Parameters:
		   lapizzeria_options = the parent (the slug, not the function with the same name)
		   Reservations = the page title
		   Reservations = the menu title
		   administrator = which user should see this menu option
		   lapizzeria_reservations = the slug for the menu
		   lapizzeria_reservations = the function that will be executed once in this page
		*/
	}
	
	add_action('admin_menu', 'lapizzeria_options'); //adding the options menu, so that it looks like Pages (with sub-links and such)
	
	function lapizzeria_settings() {
		//group for Google maps
		register_setting('lapizzeria_options_gmaps', 'lapizzeria_gmap_latitude'); //WP function that takes 2 parameters: a group and a setting. In this case, all the settings are related to G Maps (lat, lng, zoom, API key)
		register_setting('lapizzeria_options_gmaps', 'lapizzeria_gmap_longitude');
		register_setting('lapizzeria_options_gmaps', 'lapizzeria_gmap_zoom_level');
		register_setting('lapizzeria_options_gmaps', 'lapizzeria_gmap_api_key');
		
		//group for the address in the header and footer
		register_setting('lapizzeria_options_info', 'lapizzeria_address');
		register_setting('lapizzeria_options_info', 'lapizzeria_phone_number');
	}
	
	add_action('init', 'lapizzeria_settings');
	
	function lapizzeria_adjustments() {
?>
		<div class="wrap"> <!-- wrap is a class that WP provides for the backend -->
			<h1>La Pizzeria Adjustments</h1>
			<form action="options.php" method="post"> <!-- options.php is a file under the folder wp-admin that has the functionality needed for this -->
				<?php
					settings_fields('lapizzeria_options_gmaps'); //WP function that takes the group of settings to display
					do_settings_sections('lapizzeria_options_gmaps'); //WP function that takes the group of settings to display
				?>
				<h2>Google Maps</h2>
				<table class="form-table">
					<tr valign="top">
						<th scope="row">Latitude:</th>
						<td>
							<input type="text" name="lapizzeria_gmap_latitude" value="<?php echo esc_attr(get_option('lapizzeria_gmap_latitude')); ?>">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">Longitude:</th>
						<td>
							<input type="text" name="lapizzeria_gmap_longitude" value="<?php echo esc_attr(get_option('lapizzeria_gmap_longitude')); ?>">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">Zoom Level:</th>
						<td>
							<input type="number" min="12" max="21" name="lapizzeria_gmap_zoom_level" value="<?php echo esc_attr(get_option('lapizzeria_gmap_zoom_level')); ?>"> 
							<!-- min = 12 is an optional value to enable the user to control how much the map will zoom out;
								 max = 21 because it's the max zoom level that Google Maps allows-->
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">API Key:</th>
						<td>
							<input type="text" name="lapizzeria_gmap_api_key" value="<?php echo esc_attr(get_option('lapizzeria_gmap_api_key')); ?>">
						</td>
					</tr>
				</table>
				
				<?php
					settings_fields('lapizzeria_options_info'); //WP function that takes the group of settings to display
					do_settings_sections('lapizzeria_options_info'); //WP function that takes the group of settings to display
				?>
				<h2>Other Adjustments</h2>
				<table class="form-table">
					<tr valign="top">
						<th scope="row">Address:</th>
						<td>
							<input type="text" name="lapizzeria_address" value="<?php echo esc_attr(get_option('lapizzeria_address')); ?>">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">Phone Number:</th>
						<td>
							<input type="text" name="lapizzeria_phone_number" value="<?php echo esc_attr(get_option('lapizzeria_phone_number')); ?>">
						</td>
					</tr>
				</table>
				
				<?php submit_button(); //WP function that generates a "Save changes" button in the style of WP ?>
			</form>
		</div> <!-- ./wrap -->
<?php
		
	}
	
	function lapizzeria_reservations() {
?>
		<div class="wrap"> <!--wrap is a class that WP provides for the backend -->
			<h1>Reservations</h1>
			<table class="wp-list-table widefat striped"> <!-- all WP classes -->
				<thead>
					<tr>
						<th class="manage-column">ID</th>
						<th class="manage-column">Name</th>
						<th class="manage-column">Reservation Date</th>
						<th class="manage-column">E-mail</th>
						<th class="manage-column">Phone Number</th>
						<th class="manage-column">Message</th>
					</tr>
				</thead>
				<tbody>
					<?php
						global $wpdb;
						$table = $wpdb->prefix . 'reservations';
						$reservations = $wpdb->get_results("SELECT * FROM $table", ARRAY_A); //querying the custom table; ARRAY_A = associative array
						foreach($reservations as $reservation):
					?>
					<tr>
						<td><?php echo $reservation['id']; ?></td>
						<td><?php echo $reservation['name']; ?></td>
						<td><?php echo $reservation['date']; ?></td>
						<td><?php echo $reservation['email']; ?></td>
						<td><?php echo $reservation['phone']; ?></td>
						<td><?php echo $reservation['message']; ?></td>
					</tr>
						
					<?php endforeach; ?>
				</tbody>
			</table>
		</div> <!-- ./wrap -->
<?php	
	}
?>
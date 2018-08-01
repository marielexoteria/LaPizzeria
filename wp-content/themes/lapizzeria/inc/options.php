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

	function lapizzeria_adjustments() {
		//Rest of the code
	}

	function lapizzeria_reservations() {
?>
		<div class="wrap"> <!-- wrap is a class that WP provides for the backend -->
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
		</div>
<?php
	}
?>

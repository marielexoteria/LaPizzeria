<?php
	function lapizzeria_save_reservation() {
		global $wpdb; //needs to be used when creating and working with databases in WP as shown below
		
		if ((isset($_POST['reservation'])) && $_POST['hidden'] == "1") { //retrieving the data from the HTML form made in page-reservation.php (not with a plugin)
			$name = sanitize_text_field($_POST['name']); //https://codex.wordpress.org/Validating_Sanitizing_and_Escaping_User_Data
			$date = sanitize_text_field($_POST['date']);
			$email = sanitize_email($_POST['email']); //https://codex.wordpress.org/Function_Reference/sanitize_email
			$phone = sanitize_text_field($_POST['phone']);
			$message = sanitize_text_field($_POST['message']);
			
			$table = $wpdb->prefix . 'reservations';
			
			//WP requires storing data in an array; 'name' and so on are the table field names
			$data = array(
				'name' => $name,
				'date' => $date,
				'email' => $email,
				'phone' => $phone,
				'message' => $message
			); 
			
			//to specify the format of the data entered so that it matches the data type in the table; %s = string
			$format = array(
				'%s',
				'%s',
				'%s',
				'%s',
				'%s'
			); 

			//inserting the data into the custom table (wp_reservations)
			$wpdb->insert($table, $data, $format);
			
			$url = get_page_by_title('Thanks for your reservation!'); //WP function that will return the ID of the page that is between (); the parameter passed is the title of the page
			wp_redirect(get_permalink($url)); //WP function that will redirect the user to another page; get_permalink() is a WP function that will return the URL of the page ID given
			exit(); //when using wp_redirect(), exit() is needed and should be placed right after
		}
	}
	
	add_action('init', 'lapizzeria_save_reservation');
?>
<?php
	function lapizzeria_delete_reservation() {
		if ($_POST['type'] == 'delete') :
			global $wpdb; //needs to be used when creating and working with custom databases in WP
			$table = $wpdb->prefix . 'reservations';
			$id_reservation = $_POST['id'];

			$result = $wpdb->delete($table, array('id' => $id_reservation), array('%d')); //3 paramaters: (1) table to delete from; (2) an array that will send the info needed to build the WHERE clause in the SQL DELETE syntax; (3) the data type (optional) - in this case %d = integers
			//if the delete was successful, $result will be assigned a value of 1 automatically

			if ($result == 1) {
				$response = array(
					'response' => 'success',
					'id' => $id_reservation
				);
			} else {
				$response = array(
					'response' => 'error'
				);
			}
		endif;

		die(json_encode($response)); //MUST use when using AJAX in WP
	}
	add_action('wp_ajax_lapizzeria_delete_reservation', 'lapizzeria_delete_reservation');


	function lapizzeria_save_reservation() {
		if ((isset($_POST['reservation'])) && $_POST['hidden'] == "1") { //retrieving the data from the HTML form made in page-reservation.php (not with a plugin)
			//beginning of: adding the server-side recaptcha code

			$captcha = $_POST['g-recaptcha-response']; //reads the value from recaptcha response

			//sending the values to the server (as specified in the recaptcha page)
			 $fields = array(
				 'secret' => '6Lei4mkUAAAAAFhofJOvDXaM5vqjohxSHcEE0kKD',
				 'response' => $captcha,
				 'remoteip' => $_SERVER['REMOTE_ADDR']
			 );

			//starting the request to the recaptcha server
			$ch = curl_init('https://www.google.com/recaptcha/api/siteverify'); //PHP function

			//configuring the request
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //PHP function
			curl_setopt($ch, CURLOPT_TIMEOUT, 15);

			//sending the encoded values in the URL
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields));

			//reading the return value
			$response = json_decode(curl_exec($ch));
			var_dump($_POST['g-recaptcha-response']);

			if($response->success) { //en el trabajo uso $response.success == true porque esta línea no funciona allá, pero en la macbook sí
				global $wpdb; //needs to be used when creating and working with custom databases in WP
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

				//echo "data sent from the form: ". json_encode($data);

				//inserting the data into the custom table (wp_reservations)
				$wpdb->insert($table, $data, $format);

				$url = get_page_by_title('Thanks for your reservation!'); //WP function that will return the ID of the page that is between (); the parameter passed is the title of the page
				wp_redirect(get_permalink($url)); //WP function that will redirect the user to another page; get_permalink() is a WP function that will return the URL of the page ID given
				exit(); //when using wp_redirect(), exit() is needed and should be placed right after

			}
			//end of: adding the server-side recaptcha code

		}
	}

	add_action('init', 'lapizzeria_save_reservation');
?>

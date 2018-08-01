<?php
	function lapizzeria_reservations_database() {
		global $wpdb; //needs to be used when creating and working with databases in WP as shown below
		
		global $lapizzeria_db_version;
		$la_pizzeria_db_version = 1.0;
		
		$table = $wpdb->prefix . 'reservations';
		
		$charset_collate = $wpdb->get_charset_collate();
		
		//SQL statement to create the table
		$sql = "CREATE TABLE $table (
			id mediumint(9)	NOT NULL AUTO_INCREMENT,
			name varchar(50) NOT NULL,
			date datetime NOT NULL,
			email varchar(50) DEFAULT '' NOT NULL,
			phone varchar(10) NOT NULL,
			message longtext NOT NULL,
			PRIMARY KEY (id)
		) $charset_collate";
		
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php'); //needed when creating tables this way
		dbDelta($sql); //needed when creating tables this way
	}
	
	add_action('after_setup_theme', 'lapizzeria_reservations_database');
?>
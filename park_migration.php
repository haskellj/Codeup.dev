<?php
	// Define constants to be used in the PDO call before the db_connect.php file is required
	define ('DB_HOST', '127.0.0.1');
	define ('DB_NAME', 'parks_db');
	define ('DB_USER', 'parks_user');
	define ('DB_PASS', 'password');

	require 'db_connect.php';

	$drop = 'DROP TABLE IF EXISTS national_parks';
	$dbc->exec($drop);

	$query = 'CREATE TABLE IF NOT EXISTS national_parks (
		id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	    name  VARCHAR(50) NOT NULL,
	    location VARCHAR (240) NOT NULL,
	    date_established DATE NOT NULL,
	    area_in_acres DOUBLE(10,2) NOT NULL,
	    description TEXT NOT NULL,
	    PRIMARY KEY (id), 
	    CONSTRAINT user_name_unq UNIQUE (name)	-- avoids duplicate entries of parks
		)';

	$dbc->exec($query);		// Executes the code within $query and returns the number of rows affected


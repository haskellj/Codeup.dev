<?php
	// Define constants to be used in the PDO call before the db_connect.php file is required
	define ('DB_HOST', '127.0.0.1');
	define ('DB_NAME', 'parks_db');
	define ('DB_USER', 'parks_user');
	define ('DB_PASS', 'password');

	require 'db_connect.php';

	$emptyTable = 'TRUNCATE TABLE national_parks';
	$dbc->exec($emptyTable);

	$query = 
		"INSERT INTO national_parks (name, location, date_established, area_in_acres)
		VALUES ('Acadia', 'Maine', '1919-02-26', 47389.67),
				('American Samoa', 'American Samoa', '1988-10-31', 9000)";

	$dbc->exec($query);
<?php
	// Define constants to be used in the PDO call before the db_connect.php file is required
	define ('DB_HOST', '127.0.0.1');
	define ('DB_NAME', 'parks_db');
	define ('DB_USER', 'parks_user');
	define ('DB_PASS', 'password');

	require 'db_connect.php';

	$emptyTable = 'TRUNCATE TABLE national_parks';
	$dbc->exec($emptyTable);

	$parks = [
		['name' => 'Acadia', 'location' => 'Maine', 'date' => '1919-02-26', 'area' => 47389.67],
		['name' => 'American Samoa', 'location' => 'American Samoa', 'date' => '1988-10-31', 'area' => 9000]
	];

	foreach ($parks as $park) {
		$query = "INSERT INTO national_parks (name, location, date_established, area_in_acres)
					VALUES ('{$park['name']}', '{$park['location']}', '{$park['date']}', '{$park['area']}')";

		$dbc->exec($query);
		echo "Inserted ID: ".$dbc->lastInsertId().PHP_EOL;
	}


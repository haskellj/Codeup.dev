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
		['name'=>'Acadia', 			'location'=>'Maine', 			'date'=>'1919-02-26', 'area'=>47389.67],
		['name'=>'American Samoa', 	'location'=>'American Samoa', 	'date'=>'1988-10-31', 'area'=>9000],
		['name'=>'Arches', 			'location'=>'Utah', 			'date'=>'1929-04-12', 'area'=>76518.98],
		['name'=>'Badlands', 		'location'=>'South Dakota', 	'date'=>'1978-11-10', 'area'=>242755.94],
		['name'=>'Big Bend', 		'location'=>'Texas', 			'date'=>'1944-06-12', 'area'=>801163.21],
		['name'=>'Biscayne', 		'location'=>'Florida', 			'date'=>'1980-06-28', 'area'=>172924.07],
		['name'=>'Carlsbad Caverns','location'=>'New Mexico', 		'date'=>'1930-05-14', 'area'=>46766.45],
		['name'=>'Channel Islands', 'location'=>'California', 		'date'=>'1980-03-05', 'area'=>249561],
		['name'=>'Denali', 			'location'=>'Alaska', 			'date'=>'1917-02-26', 'area'=>4740911.72]
	];

	foreach ($parks as $park) {
		$query = "INSERT INTO national_parks (name, location, date_established, area_in_acres)
					VALUES ('{$park['name']}', '{$park['location']}', '{$park['date']}', '{$park['area']}')";

		$dbc->exec($query);
		echo "Inserted ID: ".$dbc->lastInsertId().PHP_EOL;
	}


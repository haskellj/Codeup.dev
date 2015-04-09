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
		['name'=>'Denali', 			'location'=>'Alaska', 			'date'=>'1917-02-26', 'area'=>4740911.72],
		['name'=>'Dry Tortugas', 	'location'=>'Florida', 			'date'=>'1992-10-26', 'area'=>64701.22],
		['name'=>'Everglades', 		'location'=>'Florida', 			'date'=>'1934-05-30', 'area'=>1047116],
		['name'=>'Grand Canyon', 	'location'=>'Arizona', 			'date'=>'1919-02-26', 'area'=>1217403.32],
		['name'=>'Grand Teton', 	'location'=>'Wyoming', 			'date'=>'1929-02-26', 'area'=>309994.66],
		['name'=>'Haleakala', 		'location'=>'Hawaii', 			'date'=>'1916-08-01', 'area'=>29093.67],
		['name'=>'Isle Royale', 	'location'=>'Michigan', 		'date'=>'1940-04-03', 'area'=>571790.11],
		['name'=>'Joshua Tree', 	'location'=>'California', 		'date'=>'1994-10-31', 'area'=>789745.47],
		['name'=>'Katmai', 			'location'=>'Alaska', 			'date'=>'1980-12-02', 'area'=>3674529.68],

	];
	
	// Query and Prepare the database once, before the foreach loop
	$query = "INSERT INTO national_parks (name, location, date_established, area_in_acres)
				VALUES (:name, :location, :date_est, :area)";
	$stmt = $dbc->prepare($query);
	
	foreach ($parks as $park) {	
		$stmt->bindValue(':name', $park['name'], PDO::PARAM_STR);
		$stmt->bindValue(':location', $park['location'], PDO::PARAM_STR);
		$stmt->bindValue(':date_est', $park['date'], PDO::PARAM_STR);
		$stmt->bindValue(':area', $park['area'], PDO::PARAM_STR);
		$stmt->execute();
		
		echo "Inserted ID: ".$dbc->lastInsertId().PHP_EOL;
	}


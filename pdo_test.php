<?php
	// Define constants to be used in the PDO call before the db_connect.php file is required
	// Note: 'password' has been left ambiguous for the github commit
	define ('DB_HOST', '127.0.0.1');
	define ('DB_NAME', 'employees');
	define ('DB_USER', 'codeup');
	define ('DB_PASS', 'password');

	require 'db_connect.php';


	$query = 'CREATE TABLE IF NOT EXISTS users (
		id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	    email VARCHAR(240) NOT NULL,
	    name  VARCHAR(50) NOT NULL,
	    PRIMARY KEY (id), 
	    CONSTRAINT user_email_unq UNIQUE (email)	-- avoids duplicate entries of artist-album name combinations
		)';

	$dbc->exec($query);		// Executes the code within $query and returns the number of rows affected

	$query = "INSERT INTO users (email, name)
				VALUES ('ben@codeup.com,'Ben Batschelet')";

	// Execute Query, save the result as a variable
	$numRows = $dbc->exec($query);
	echo "Inserted $numRows row(s).".PHP_EOL;

	$users = [
		['email' => 'jason@codeup.com', 'name' => 'Jason Straughn'],
		['email' => 'michael@codeup.com', 'name' => 'Michael Girdley'],
		['email' => 'chris@codeup.com', 'name' => 'Chris Turner']
	];

	foreach ($users as $user) {
		$query = "INSERT INTO users (email, name) VALUES ('{$user['email']}', '{$user['name']}')";

		$dbc->exec($query);

		echo "Inserted id ";
	}






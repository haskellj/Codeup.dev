<?php
	// Get new instance of PDO object and point it toward the 'employees' database
	// Note: the password has been left ambiguous for github commits
	$dbc = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);

	// Tell PDO to throw exceptions on error, rather than failing silently
	$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// Display the PDO connection status
	echo $dbc->getAttribute(PDO::ATTR_CONNECTION_STATUS) . "\n";


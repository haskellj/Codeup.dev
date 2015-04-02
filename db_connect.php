<?php
	// Get new instance of PDO object and point it toward the 'employees' database
	// Note: the password has been left ambiguous for github commits
	$dbc = new PDO('mysql:host=127.0.0.1;dbname=employees', 'codeup', 'password');

	// Tell PDO to throw exceptions on error, rather than failing silently
	$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


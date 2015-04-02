<?php

	require 'db_connect.php';
	
	// Display the PDO connection status
	echo $dbc->getAttribute(PDO::ATTR_CONNECTION_STATUS) . "\n";

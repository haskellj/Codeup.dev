<?php

	// returns true or false based on whether the key exists in either $_GET or $_REQUEST.
	inputHas($key) 
	{
		return isset($_REQUEST[$key]) ? true : false;
	}


	// returns the value specified by the key, or null if the key is not set.
	inputGet($key)
	{
		return isset($_REQUEST[$key]) ? $_REQUEST[$key] : null; 
	}


	// returns the input as a safely escaped string.
	escape($input)
	{
		return htmlentities(strip_tags($input));
	}

?>
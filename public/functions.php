<?php

	// returns true or false based on whether the key exists in either $_GET or $_REQUEST.
	inputHas($key) 
	{
		$result = isset($_REQUEST["$key"]) ? true : false;
		return $result;
	}



	// returns the value specified by the key, or null if the key is not set.
	inputGet($key)
	{
		$result = isset($_REQUEST["$key"]) ? $_REQUEST["$key"] : null; 
		return $result;
	}


	// returns the input as a safely escaped string.
	escape($input)
	{
		return htmlspecialchars(strip_tags($input));
	}

?>
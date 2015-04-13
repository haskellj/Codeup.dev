<?php
	
	class Model
	{
		private $attributes = array();

		// Magic setter to populate the $attributes array
		public function __set($name, $value)
		{
			// Create key/value pairs by setting $name key to hold the $value in the array
			$this->attributes[$name] = $value;
		}

		// Magic getter to retrieve values from the attributes array based on the key name, provided it exists
		public function __get($name)
		{
			if(array_key_exists($name, $this->attributes)) {
				return $this->attributes[$name];
			}

			return null;
		}
	}

	// Test class:
	$new = new Model();
	$new->name = 'Sir Test';
	$new->group = 'Knights of the CodeTable';
	$new->age = 35;
	$new->motto = 'This code shall not pass!';

	echo $new->name.PHP_EOL;
	echo $new->group.PHP_EOL;
	echo $new->age.PHP_EOL;
	echo $new->motto.PHP_EOL;
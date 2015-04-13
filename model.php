<?php
	
	define ('DB_HOST', '127.0.0.1');
	define ('DB_NAME', 'parks_db');
	define ('DB_USER', 'parks_user');
	define ('DB_PASS', 'password');



	class Model
	{
		protected static $dbc;
	    protected static $table;

	    public $attributes = array();

	   
	    public function __construct()
	    {
	        self::dbConnect();
	    }

	    // Connect to the database, if it hasn't been connected to already.
	    private static function dbConnect()
	    {
	        if (!self::$dbc)
	        {
	    		self::$dbc = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);

				// Tell PDO to throw exceptions on error, rather than failing silently
				self::$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				// // Display the PDO connection status
				self::$dbc->getAttribute(PDO::ATTR_CONNECTION_STATUS) . "\n";
	    		echo 'You are connected to the database';
	        } else {
	        	echo 'Connection to the database failed';
	    	}
	    }

		// Magic setter to populate the $attributes array
		// public function __set($name, $value)
		// {
		// 	// Create key/value pairs by setting $name key to hold the $value in the array
		// 	$this->attributes[$name] = $value;
		// }

		// // Magic getter to retrieve values from the attributes array based on the key name, provided it exists
		// public function __get($name)
		// {
		// 	if(array_key_exists($name, $this->attributes)) {
		// 		return $this->attributes[$name];
		// 	}

		// 	return null;
		// }

		// public static function getTableName()
		// {
		// 	return static::$table;
		// }

	 //    // Persist the object to the database
	 //    public function save()
	 //    {
	 //        // Ensure there are attributes before attempting to save
	 //        if (!empty($this->attributes)) {

		//         // Perform the proper action - if the `id` is set, this is an update, if not it is a insert
		//         // If inserting new id, add the id to the attributes array so the object can properly reflect the id as well
	 //        	if(isset($this->id)){
	 //        		$query = "UPDATE national_parks
		// 						SET location=".$this->location.", date_established=".$this->date_established.", 
		// 							area_in_acres=".$this->area_in_acres.", description=".$this->description.
		// 						"WHERE id=".$this->id;
	 //        	} else {
	 //        		$query = "INSERT INTO national_parks (name, location, date_established, area_in_acres, description)
		// 						VALUES (:name, :location, :date_est, :area, :description)";
		// 			$this->id = $this->id;
	 //        	}

	 //        	// You will need to iterate through all the attributes to build the prepared query
	 //        	foreach($this->attributes as $attribute) {

	 //        	}

		//         // Use prepared statements to ensure data security
		//         $insert = $dbc->prepare($query);
		// 	}

	 //    // Find a record based on an id
	 //    public static function find($id)
	 //    {
	 //        // Get connection to the database
	 //        self::dbConnect();

	 //        // @TODO: Create select statement using prepared statements

	 //        // @TODO: Store the resultset in a variable named $result

	 //        // The following code will set the attributes on the calling object based on the result variable's contents

	 //        $instance = null;
	 //        if ($result)
	 //        {
	 //            $instance = new static;
	 //            $instance->attributes = $result;
	 //        }
	 //        return $instance;
	 //    }

	 //    // Find all records in a table
	 //    public static function all()
	 //    {
	 //        self::dbConnect();

	 //        // @TODO: Learning from the previous method, return all the matching records
	 //    }

	}

	// Test class:
	$aishaTyler = new Model();
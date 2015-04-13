<?php
	
	define ('DB_HOST', '127.0.0.1');
	define ('DB_NAME', '');
	define ('DB_USER', '');
	define ('DB_PASS', 'password');

	require_once 'db_connect.php';

	class Model
	{
		protected static $dbc;
	    protected static $table;

	    public $attributes = array();

	   
	    public function __construct()
	    {
	        self::dbConnect();
	    }

	    // Connect to the database
	    private static function dbConnect()
	    {
	        if (!self::$dbc)
	        {
	            // @TODO: Connect to database
	        }
	    }

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

		public static function getTableName()
		{
			return static::$table;
		}

	    // Persist the object to the database
	    public function save()
	    {
	        // @TODO: Ensure there are attributes before attempting to save

	        // @TODO: Perform the proper action - if the `id` is set, this is an update, if not it is a insert

	        // @TODO: Ensure that update is properly handled with the id key

	        // @TODO: After insert, add the id back to the attributes array so the object can properly reflect the id

	        // @TODO: You will need to iterate through all the attributes to build the prepared query

	        // @TODO: Use prepared statements to ensure data security


	    // Find a record based on an id
	    public static function find($id)
	    {
	        // Get connection to the database
	        self::dbConnect();

	        // @TODO: Create select statement using prepared statements

	        // @TODO: Store the resultset in a variable named $result

	        // The following code will set the attributes on the calling object based on the result variable's contents

	        $instance = null;
	        if ($result)
	        {
	            $instance = new static;
	            $instance->attributes = $result;
	        }
	        return $instance;
	    }

	    // Find all records in a table
	    public static function all()
	    {
	        self::dbConnect();

	        // @TODO: Learning from the previous method, return all the matching records
	    }

	}

	// Test class:
	// $new = new Model();
	// $new->name = 'Sir Test';
	// $new->group = 'Knights of the CodeTable';
	// $new->age = 35;
	// $new->motto = 'This code shall not pass!';

	// echo $new->name.PHP_EOL;
	// echo $new->group.PHP_EOL;
	// echo $new->age.PHP_EOL;
	// echo $new->motto.PHP_EOL;
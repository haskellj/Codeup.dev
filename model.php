<?php
	// Database credentials
	define ('DB_HOST', '127.0.0.1');
	define ('DB_NAME', 'parks_db');
	define ('DB_USER', 'parks_user');
	define ('DB_PASS', 'password');



	class Model
	{
		protected static $dbc;
	    protected static $table = 'national_parks';
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
	        	// PDO call to database that passes in the credentials
	    		self::$dbc = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);

				// Tell PDO to throw exceptions on error, rather than failing silently
				self::$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				// // Display the PDO connection status
				echo self::$dbc->getAttribute(PDO::ATTR_CONNECTION_STATUS) . "\n";
	    		
	    		echo "You are connected to the database.\n";

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
	        // Ensure there are attributes before attempting to save
	        if (!empty($this->attributes)) {

	        	// Get column names as an array, create a duplicate for prepared statement placeholders
				$columns = array_keys($this->attributes);
				$columnsPlaceholders = $columns;

				// Put a colon on the front of each of the placeholders for use in the query
				array_walk($columnsPlaceholders, function(&$value, $key) {$value = ':' . $value;});

	        	// Perform the proper action - if the `id` is set, this is an update, if not it is a insert
		        // Attempt to insert, but if a 'duplicate' exception is thrown, attempt to update intead
		        if (!isset($this->id)) {
		        	$this->insert($columns, $columnsPlaceholders);
		        } else {
		        	$this->update($columns, $columnsPlaceholders);
		        }
			}
		}

		public function insert($columns, $columnsPlaceholders)
		{
			$columns = implode(',', $columns);	// creates a string of comma-separated column names
			$columnsPlaceholders = implode(',', $columnsPlaceholders);	// creates a string of comma-separated placeholder names

        	// Use prepared statements to ensure data security
        	$insertQuery = "INSERT INTO " . static::$table . " (" . $columns . ") 
        						VALUES (" . $columnsPlaceholders . ")";

			$insert = self::$dbc->prepare($insertQuery);

        	// You will need to iterate through all the attributes to bind the placeholder variables in the prepared query to their values
			foreach ($this->attributes as $key => $attribute) {
	    		$insert->bindValue(":" . $key, $attribute, PDO::PARAM_STR);
			}

			$insert->execute();

			// If inserting new id, add the id to the attributes array so the object can properly reflect the id as well
			$this->id = self::$dbc->lastInsertId();
		}

		public function update($columns, $columnsPlaceholders)
		{
			// Go through the placeholders array and put a comma at the back of each value for use in the query,
			array_walk($columnsPlaceholders, function(&$value, $key) {$value = $value . ',';});
			// But remove the comma from the last value
			$lastElement = array_pop($columnsPlaceholders);
			$lastElement = str_split($lastElement);
			array_pop($lastElement);
			$lastElement = implode($lastElement);
			array_push($columnsPlaceholders, $lastElement);


			// Combine the columns and placeholders array into a single array where the columns are the keys and the placeholders are the values
			$combinedArray = array_combine($columns, $columnsPlaceholders);
			$set = '';	// an empty variable to concatinate onto in the foreach loop
			
			foreach ($combinedArray as $key => $value) {
				$set .= "$key = $value "; 
			}

			// Dynamically build the update statement
			$updateQuery = "UPDATE " . static::$table . 
								" SET " . $set .
								"WHERE id= :id";			
			$update = self::$dbc->prepare($updateQuery);

        	// You will need to iterate through all the attributes to bind the placeholder variables in the prepared query to their values
	        foreach ($this->attributes as $key => $attribute) {
	    		$update->bindValue(":" . $key, $attribute, PDO::PARAM_STR);
			}

			$update->execute();
	        	
		}

		// Get an array of all the field names in the table, but remove the id field
		public static function getColumnNames()
		{
			self::dbConnect();
			$stmt = self::$dbc->query("DESCRIBE " . static::$table);
			$table_fields = $stmt->fetchAll(PDO::FETCH_COLUMN);
			unset($table_fields[0]);
			// print_r($table_fields);
		}

	    // Find a record based on an id
	    public static function find($id)
	    {
	        // Get connection to the database
	        self::dbConnect();

	        // @TODO: Create select statement using prepared statements
	        $stmt = self::$dbc->prepare("SELECT * FROM " . static::$table . " WHERE id = :id");
			$stmt->bindValue(':id', $id, PDO::PARAM_INT);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_ASSOC);


	        // The following code will create a new object instance of the Model class. 
	        // Its attributes array will contain the record of the found id
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

	        return self::$dbc->query('SELECT * FROM ' . static::$table . ';')->fetchAll(PDO::FETCH_ASSOC);
	    }

	}

	// Test class:
	// $blah = new Model();
	// $blah->id = 50;
	// $blah->name = "Blah III";
	// $blah->location = "Canada";
	// $blah->date_established = "2015-04-11";
	// $blah->area_in_acres = "0.5";
	// $blah->description = "She is a country music singer.";
	
	// $blah->save();
	
	// // print_r(Model::find('22'));
	// // print_r(Model::all());

	// // print_r($AishaTyler->attributes);

	// Model::getColumnNames();
	

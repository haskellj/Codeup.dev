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

	        } else {
	        	echo "Connection to the database failed\n";
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

	        	// Use prepared statements to ensure data security
	        	$insertQuery = "INSERT INTO " . static::$table . " (name, location, date_established, area_in_acres, description)
									VALUES (:name, :location, :date_est, :area, :description)";
				$insert = self::$dbc->prepare($insertQuery);
				
				$updateQuery = "UPDATE " . static::$table . 
									" SET name= :name, location= :location, date_established= :date_est, 
										area_in_acres= :area, description= :description
									WHERE id= :id";			
				$update = self::$dbc->prepare($updateQuery);

	        	// You will need to iterate through all the attributes to bind the placeholder variables in the prepared query to their values
		        // foreach($this->attributes as $key => $value) {

			        // Perform the proper action - if the `id` is set, this is an update, if not it is a insert
			        // If inserting new id, add the id to the attributes array so the object can properly reflect the id as well
		        	if(isset($this->attributes["id"])){
		        		$update->bindValue(":name", $this->attributes["name"], PDO::PARAM_STR);
						$update->bindValue(":location", $this->attributes["location"], PDO::PARAM_STR);
						$update->bindValue(":date_est", $this->attributes["date"], PDO::PARAM_STR);
						$update->bindValue(":area", $this->attributes["area"], PDO::PARAM_STR);
						$update->bindValue(":description", $this->attributes["description"], PDO::PARAM_STR);
						$update->bindValue(":id", $this->attributes["id"], PDO::PARAM_INT);
						$update->execute();
		        	} else {
		        		$insert->bindValue(":name", $this->attributes["name"], PDO::PARAM_STR);
						$insert->bindValue(":location", $this->attributes["location"], PDO::PARAM_STR);
						$insert->bindValue(":date_est", $this->attributes["date"], PDO::PARAM_STR);
						$insert->bindValue(":area", $this->attributes["area"], PDO::PARAM_STR);
						$insert->bindValue(":description", $this->attributes["description"], PDO::PARAM_STR);
						$insert->execute();
						
						$this->id = self::$dbc->lastInsertId();
		        	}
				// }	        	
			}
		}

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
	$AishaTyler = new Model();
	$AishaTyler->name = "Aisha Tyler";
	$AishaTyler->location = "Hollywood";
	$AishaTyler->date = "2015-04-14";
	$AishaTyler->area = "0.3";
	$AishaTyler->description = "She is a model and the current host of Who's Line is it Anyway";
	
	// $AishaTyler->save();
	

	print_r($AishaTyler->attributes);
	

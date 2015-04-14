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
	        	// Perform the proper action - if the `id` is set, this is an update, if not it is a insert
		        // Attempt to insert, but if a 'duplicate' exception is thrown, attempt to update intead
		        if (!isset($this->id)) {
		        	$this->insert();
		        } else {
		        	$this->update();
		        }
			}
		}

		public function insert()
		{
        	// Use prepared statements to ensure data security
        	$insertQuery = "INSERT INTO " . static::$table . " (name, location, date_established, area_in_acres, description)
								VALUES (:name, :location, :date_est, :area, :description)";
			
			$insert = self::$dbc->prepare($insertQuery);
    		
    		$insert->bindValue(":name", $this->name, PDO::PARAM_STR);
			$insert->bindValue(":location", $this->location, PDO::PARAM_STR);
			$insert->bindValue(":date_est", $this->date, PDO::PARAM_STR);
			$insert->bindValue(":area", $this->area, PDO::PARAM_STR);
			$insert->bindValue(":description", $this->description, PDO::PARAM_STR);
			$insert->execute();

			// If inserting new id, add the id to the attributes array so the object can properly reflect the id as well
			$this->id = self::$dbc->lastInsertId();
		}

		public function update()
		{
			// Use prepared statements to ensure data security
			$updateQuery = "UPDATE " . static::$table . 
								" SET name= :name, location= :location, date_established= :date_est, 
									area_in_acres= :area, description= :description
								WHERE id= :id";			
			$update = self::$dbc->prepare($updateQuery);

        	// You will need to iterate through all the attributes to bind the placeholder variables in the prepared query to their values
	        // foreach($this->attributes as $key => $value) {

    		$update->bindValue(":name", $this->attributes["name"], PDO::PARAM_STR);
			$update->bindValue(":location", $this->attributes["location"], PDO::PARAM_STR);
			$update->bindValue(":date_est", $this->attributes["date"], PDO::PARAM_STR);
			$update->bindValue(":area", $this->attributes["area"], PDO::PARAM_STR);
			$update->bindValue(":description", $this->attributes["description"], PDO::PARAM_STR);
			$update->bindValue(":id", $this->attributes["id"], PDO::PARAM_INT);
			$update->execute();
	        	
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
	// $blah->name = "Mrs. Blah";
	// $blah->location = "Canada";
	// $blah->date = "2015-04-11";
	// $blah->area = "0.5";
	// $blah->description = "She is a country music singer.";
	
	// $blah->save();
	
	// print_r(Model::find('22'));
	print_r(Model::all());

	// print_r($AishaTyler->attributes);
	

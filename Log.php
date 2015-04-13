<?php
	class Log
	{
		protected $filename; 
		private $handle;

		// This function runs automatically whenever the class is instantiated
		// It's job is to call the filename and handle to be 'set'
		public function __construct($prefix='log')
		{
			$this->setFilename($prefix);
			$this->setHandle();
		}
		
		// Sets the protected filename when the class is instantiated, via the __construct() method 
		protected function setFilename($prefix)
		{
			// Set timezone and date format
		    date_default_timezone_set('America/Chicago');
			$date = date('Y-m-d');

			if(is_string($prefix)) {
				$this->filename = "{$prefix}-{$date}.log";
			} else {
				$this->filename = "log-{$date}.log";
			}
		}

		// Allows access to the filename, but not the ability to alter it
		public function getFilename()
		{
			return $this->filename;
		}

		// Sets the private handle when the class is insantiated, via the __construct() method
		protected function setHandle()
		{
			$thisFilename = $this->getFilename();
			$this->handle = fopen($thisFilename, 'a+');
		}

		// Allows access to the handle, but not the ability to alter it
		public function getHandle()
		{
			return $this->handle;
		}

		// Appends a message to the end of the contents of the file
		public function logMessage($logLevel, $message)
		{
		    // Set timezone and date format
		    // date_default_timezone_set('America/Chicago');
			// $date = date('Y-m-d');
		    
		    // Assign a file to the filename property inside the instance of the Log class
			// $this->filename = "log {$date}.log";
		    // $handle = fopen($this->filename, 'a+');
		    fwrite($this->handle, PHP_EOL.date("Y-m-d H:i:s") . " [$logLevel] $message");
		    // fclose($handle);
		}

		// Sends a 'logLevel' and message to be appended to the file
		public function logInfo($message)
		{
			$this->logMessage("INFO", $message);
		}

		// Sends a 'logLevel' and message to be appended to the file
		public function logError($message)
		{
			$this->logMessage("ERROR", $message);
		}

		// This function runs automatically whenever the class is instantiated
		// It's job is to close the open file that was opened and altered by the methods above
		public function __destruct()
		{
			fclose($this->getHandle());
		}
	}
?>
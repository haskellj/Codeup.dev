<?php
	class Log
	{
		public $filename; 
		public $handle;

		// This function runs automatically whenever the class is instantiated
		public function __construct($prefix='log')
		{
			// Set timezone and date format
		    date_default_timezone_set('America/Chicago');
			$date = date('Y-m-d');

			$this->filename = "{$prefix}-{$date}.log";
			$this->handle = fopen($this->filename, 'a+');
		}

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

		public function logInfo($message)
		{
			$this->logMessage("INFO", $message);
		}

		public function logError($message)
		{
			$this->logMessage("ERROR", $message);
		}

		// This function runs automatically whenever the class is instantiated
		public function __destruct()
		{
			fclose($this->handle);
		}
	}
?>
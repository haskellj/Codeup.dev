<?php
	class Log
	{
		protected $filename; 
		private $handle;

		// This function runs automatically whenever the class is instantiated
		public function __construct($prefix='log')
		{
			$this->setFilename($prefix);
			$this->setHandle();
		}

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

		public function getFilename()
		{
			return $this->filename;
		}

		protected function setHandle()
		{
			$thisFilename = $this->getFilename();
			$this->handle = fopen($thisFilename, 'a+');
		}

		public function getHandle()
		{
			return $this->handle;
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
			fclose($this->getHandle());
		}
	}
?>
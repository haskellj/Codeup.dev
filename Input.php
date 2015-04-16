<?php

class Input
{
    /**
     * Check if a given value was passed in the request
     *
     * @param string $key index to look for in request
     * @return boolean whether value exists in $_POST or $_GET
     */
    public static function has($key)
    {
        return isset($_REQUEST[$key]) ? true : false;
    }

    /**
     * Get a requested value from either $_POST or $_GET
     *
     * @param string $key index to look for in index
     * @param mixed $default default value to return if key not found
     * @return mixed value passed in request
     */
    public static function get($key, $default = null)
    {
        return isset($_REQUEST[$key]) ? $_REQUEST[$key] : $default; 
    }

    public static function getString($key)
    {
        $keyValue = self::get($key);

        if(!is_string($keyValue) || !isset($keyValue) || is_numeric($keyValue)){
            throw new exception ("$key must be a string!");
        }

        return trim($keyValue);
    }

    public static function getNumber($key)
    {
        $keyValue = trim(self::get($key));

        if(!is_numeric($keyValue) || !isset($keyValue)){
            throw new exception ("$key must be a number!");
        }

        return (float)$keyValue;
    }

    public static function getDate($key)
    {
        // Re-format the user inputted date to the correct format, using PHP library functions, before passing to MySQL 
        // If date field is left blank by the user, default to today's date
        if (!empty($_POST[$key])) {
            $userDate = date_create($_POST[$key]);
            if (!$userDate) {
                throw new exception ("Invalid date; must be in the format: YYYY-MM-DD."); 
            } else {
               return $newDate = date_format($userDate, 'Y-m-d');
            }
        } else {
            return $newDate = date('Y-m-d');
        }
    }

    ///////////////////////////////////////////////////////////////////////////
    //                      DO NOT EDIT ANYTHING BELOW!!                     //
    // The Input class should not ever be instantiated, so we prevent the    //
    // constructor method from being called. We will be covering private     //
    // later in the curriculum.                                              //
    ///////////////////////////////////////////////////////////////////////////
    private function __construct() {}
}
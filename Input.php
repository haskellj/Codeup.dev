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

        if(!is_string($keyValue) || !isset($keyValue)){
            throw new exception ('$key must be a string!');
        }

        return $keyValue;
    }

    public static function getNumber($key)
    {
        $keyValue = self::get($key);

        if(!is_numeric($keyValue) || !isset($keyValue)){
            throw new exception ('$key must be a number!');
        }

        return (float)$keyValue;
    }

    ///////////////////////////////////////////////////////////////////////////
    //                      DO NOT EDIT ANYTHING BELOW!!                     //
    // The Input class should not ever be instantiated, so we prevent the    //
    // constructor method from being called. We will be covering private     //
    // later in the curriculum.                                              //
    ///////////////////////////////////////////////////////////////////////////
    private function __construct() {}
}
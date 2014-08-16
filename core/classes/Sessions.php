<?php

class Sessions
{
	/**
	* checks if session has been set
	*
	* @param string $name
	* @return bool
	*/
	public static function exists($name)
	{
		return isset($_SESSION[$name]) ? true : false ;
	}
	
	/**
	* gets all information from session
	* if key has been passed it will return value of key
	*
	* @param string $name
	* @param int $key
	*/
	public static function get($name, $key = null)
	{
		if(self::exists($name))
		{
			if($key)
			{
				return $_SESSION[$name][$key];
			} 
			else 
			{
				return  $_SESSION[$name];
			}
		}
	}
	
	/**
	* puts data into the session 
	*
	* @param string $name
	* @param int $key
	* @param int $value
	*/
	public static function put($name, $key, $value) 
	{
		return $_SESSION[$name][$key] = $value;
	}

	
	/**
	* removes a session
	*
	* @param string $name
	* @return void
	*/
	public static function clear($name, $key = null) 
	{
		if(self::exists($name)) 
		{
			if($key) 
			{
				unset($_SESSION[$name][$key]);
			} 
			else 
			{
				unset($_SESSION[$name]);
			}
		} 
	}
	
}

?>
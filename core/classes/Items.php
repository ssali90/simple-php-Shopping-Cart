<?php

class Items
{

	/**
	* holds databse instance
	*/
	public $_db;
	
	/**
	* item information
	*
	* @var obj
	*/
	private $_data;
	
	/**
	* constructor
	*/
	public function __construct(db $db)
	{
		$this->_db = $db;
	} 
	
	/**
	* gets items details from database
	*
	* @return $this
	*/
	public function getDetails($id) 
	{
		$dtl = $this->_db->table('products')->get(['id', '=', $id]);
		
		if($dtl->count())
		{
			$this->_data = $dtl->first();
			
		} 
		
		return $this;
	}
	
	/**
	* @return data obj
	*/
	public function data()
	{
		return $this->_data;
	}
	
	/**
	* gets item quantity
	*/
	public function quantity() 
	{
		return $this->data()->product_quantity;
	}
	
	public function name()
	{
		return $this->data()->product_name;
	}
	
	/**
	* gets item price
	*/
	public function price() 
	{
		return $this->data()->product_price;
	}
	
	/**
	* gets all items from the table
	*/
	public function getItems($table)
	{
		$items = $this->_db->table('products')->getAll();
		
		if($items->count())
		{
			return $items->fetchObj();
		}
		
		return false;
	}
	
	/**
	* creates the mysql database that stores our items 
	* if it is not available
	*
	* @return bool
	*/
	public function create()
	{
		$sql = 'CREATE TABLE IF NOT EXISTS products
			(id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
			product_name VARCHAR(50) NOT NULL UNIQUE,
			product_description text NOT NULL,
			product_quantity int(5) NOT NULL,
			product_price decimal(5,2) NOT NULL)
				';
				
			return $this->_db->execute($sql);
	}
	
}

?>

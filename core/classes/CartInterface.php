<?php

interface cartInterface 
{

	/**
	* adds a product to the cart
	*
	* @param int $key
	* @param int $value
	*/
	public function addToCart($key, $value);
	
	/**
	* adds the quantity of product that is already in the cart
	*
	* @param int $key
	* @param int $value
	*/
	public function addQuantity($key, $value);
	
	/**
	* removes an item from a cart
	*
	* @param int $key
	*/
	public function removeItem($key);
	
	/**
	* adds up the totalprice of items in cart total
	*
	* @return int
	*/
	public function total();
	
	/**
	* counts the number of items in the cart
	*
	* @param string $string
	* @return int
	*/
	public function numbItems($string); 
	
	/**
	* updates the quanttiy of an item
	*
	* @param int $key
	* @param int $value
	*/
	public function updateQuantity($key, $value);
	
}

?>

<?php

class Cart implements cartInterface
{
	
	/**
	* holds the item instance
	*/
	private $_items;
	
	/**
	* the total price of cart
	*
	* @var float
	*/
	private $_total = null;
	
	/**
	* checks if cart is available
	*
	* @var bool
	*/
	private $_cart = false;
	
	
	/**
	* the constructor
	*/
	public function __construct(items $items)
	{
		$this->_items = $items;
		
		if(sessions::exists('cart'))
		{
			$this->_cart = true;
		}
	}
	
	/**
	* adds an item to the cart
	*
	* @param int $id
	* @param int $value
	* @return bool
	*/
	public function addToCart($id, $value)
	{ 
	
		$item = $this->items($id)->quantity();
		
		if(!$this->checkCart($id) && $value <= $item)
		{
			return sessions::put('cart',$id, $value);
		} 
		else 
		{
			$this->addQuantity($id, $value);
		}
		
		return false;
	}
	
	/**
	* checks if item is in the cart
	* @param int $key
	* @return bool
	*/
	private function checkCart($key)
	{
		$id = !count(sessions::get('cart')) ? [] : array_keys(sessions::get('cart'));
		
		return in_array($key, $id) ? true : false;
	}
	
	/**
	* adds to the product quantity if the item is already in the cart
	*
	* @param int $id
	* @param int $vale
	* @return bool
	*/
	public function addQuantity($id, $value)
	{
	
		$item = $this->items($id)->quantity();
		
		$current = sessions::get('cart', $id);

		$new_val = $current + $value;
		
			if($this->checkCart($id) && $new_val <= $item)
			{
			
				return sessions::put('cart', $id, $new_val);
			}
		
		return false;
	}
	
	/**
	* updates item quantity
	*
	* @return bool
	*/
	public function updateQuantity($key, $qty) 
	{
		$item = $this->items($key)->quantity();
			if((int)$qty === 0) 
		{
			sessions::clear('cart', $key);
		} 
		else 
		{
			if($this->checkCart($key) && $qty <= $item)
			{
				sessions::put('cart', $key, $qty);
			}
		}
		
		return false;
	}
	
	/**
	* counts the number of items in the cart
	*
	* @return bool
	*/
	public function numbItems($string)
	{
		if($this->cart())
		{
			
		$number =  array_sum(array_values(sessions::get('cart')));
		
			return $number ? $number : $string ;
		}
		
		return false;
	}
	
	/**
	* returns the total price of items
	*
	* @param int $id
	* @return float
	*/
	public function itemPrice($id) 
	{
	
		$qty = sessions::get('cart', $id);
		
			$price = $qty * $this->items($id)->price();
			
			return sprintf("%01.2f", $price);
	}
	
	/**
	* calculates the total price of items in the cart
	*
	* @return float;
	*/
	public function total() 
	{
		if($this->cart())
		{
			$id = array_keys(sessions::get('cart'));
			
			foreach( $id as $key)
			{
				$this->_total = $this->_total + $this->itemPrice($key);
			
			} 
			
			if($this->_total == 0)
			{
				sessions::clear('cart');
			}
			
			return sprintf("%01.2f", $this->_total);
		}
	}	
	
	/**
	* gets information of items in cart
	*
	* @param int $key
	*/
	public function items($key) 
	{ 
		return $this->_items->getDetails($key);
	}
	
	/**
	* removes item from cart
	*
	* @return void
	*/
	public function removeItem($key = null) 
	{
		return sessions::clear('cart', $key);
	}
	
	/**
	* @return cart
	*/
	public function cart()
	{
		return $this->_cart;
	}
}

?>

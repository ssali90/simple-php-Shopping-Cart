#simple-php-Shopping-Cart

An easy to use shopping cart that lets you add, update and remove items from a session based cart 

##configure

Products must be added to a mysql database in order to use the cart.
make sure you run the cart.sql and add your database user details to the db class located in the core/classes file

##Add
To add an item to the shopping cart call the addToCart method and supply an item id and quantity you wish to add

```
$cart->addToCart(1, 1);
```

If the item is already in the cart this method will automatically add the items quantity given it is not more than the quantity in the database

##Total
```
$cart->Total();
```
This will let you know the total price of items in the cart 

##number of items
```
$cart->numbitems();
```
Will return the number of items that have been added to the cart 

##update 
```
$cart->update()
```
Lets you update an item quantity in the cart, if a value is non numeric or is zero the items will automatically be removed from the cart 

##output items
```
if($cart->cart())
{
  foreach(sessions::get('cart') as $key => $value)
  {
    $prods = $items->getDetails($key);
      
      echo $prods->name(). '<br>';
      echo '&pound'.$cart->itemPrice($key).'<br>';
  }
}
```
if you wish to output the items in the cart use the above code and of of cause you can easliy add your own styling 




#simple-php-Shopping-Cart

An easy to use shopping cart that lets you add, update and remove items from a session based cart 

##configure

Products must be added to a mysql database in order to use the cart.
make sure you run the cart.sql and add your database user details to the db class located in the core/classes file

##Add
to add an item to the shopping cart call the addToCart method and supply an item id and quantity you wish to add
```$cart->addToCart(1, 1)```;

if the item is already in the cart this method will automatically add the given items quantity given it is not more than the quantity in the database


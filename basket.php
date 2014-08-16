<?php
include_once('core/init.php');

	$items = new items(new Db);
	$cart = new cart($items);
	
//update the product quantity
	if(isset($_POST['change']))
	{
		$value = (int)$_POST['change'];
		$key = (int)$_POST['id'];
		
		$cart->updateQuantity($key, $value);
		
			header('location:basket.php');
	}
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Basket</title>
    </head>
    <body>
		<h3>Items In Basket</h3>
	<?php
	if($cart->cart()) :
	
		foreach(sessions::get('cart') as $key => $value) : 
			$prods = $items->getDetails($key);
			
			echo $prods->name(). '<br>';
			echo '&pound'.$cart->itemPrice($key).'<br>';
	?>
			<form action='basket.php' method='post'>
				<input type='text' value='<?php echo $value; ?>' name='change' size='1' autocomplete='off'>
				<input type='hidden' name='id' value='<?php echo $key; ?>'>
			</form>
			<br>
	<?php
		endforeach; 
			echo '<strong>Total:</strong> &pound'.$cart->total().'<p>';
			
		else :
			echo 'cart is empty'.'<p>';
		endif;
	?>
		<a href='index.php'>Continue Shopping</a>
    </body>
</html>

<?php
include_once('core/init.php');
	$item = new items(new Db);
	$cart = new cart($item);

//add item to the cart
	if(isset($_POST['submit']))
	{
		$id = (int)$_POST['pid'];
		$value = (int)$_POST['value'];

		$cart->addToCart($id, $value);
			
		header('location:basket.php');
	}

//output number of items in cart	
	echo $cart->numbItems('no items in basket').'<br>';
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Items</title>
    </head>
    <body>
	<?php
//output items in database
		foreach($item->getItems('products') as $items) :
			
			echo $items->product_name.'<br>';
			echo $items->product_description.'<br>';
			echo '&pound'.$items->product_price.'<br>';
	?>
		<form action='index.php' method='post'>
			<input type='hidden' name='pid' value='<?php echo $items->id; ?>'>
			<input type='hidden' name='value' value=1>
			<input type='submit' name='submit' value='Add To Cart'>
		</form><br>
		
	<?php endforeach; ?>
    </body>
</html>

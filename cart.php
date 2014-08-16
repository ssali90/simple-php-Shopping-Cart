<?php
	
	
	if($cart->checkProducts('cart')) {
		if(Input::data('change')) {
			$cart->updateQuantity(Input::data('id'),  Input::data('change'));
		}
		
	$action = Input::data('action');
		if($action == 'empty') {
			Session::unsetSession('cart');
				Redirect::direct('cart.php');
		}
?>
	<a href="cart.php"> <?php echo $cart->outputItemCart('cart is empty'); ?> </a>

<h2> Items In Your Basket</h2>
<table width=600 cellspacing=10 cellpadding=5>
		<td><strong>name</strong></td>
		<td><strong>quantity</strong></td>
		<td><strong>price</strong></td>
	<tr>
		<?php foreach(Session::current('cart') as $key => $value) { 
			$item = $prods->getProduct($key);
		?>
		<td><a href="product.php?pid=<?php echo $item->productId(); ?>"><?php echo $item->productName(); ?></a></td>
		<td>
			<form action="" method="post">
				<input type="text" name="change" size='1' maxlength="3" value="<?php echo $value;?>">
				<input type="hidden" name="id" value="<?php echo $key;?>">
			</form>
		</td>
		<td> &pound<?php echo $cart->itemPrice($key, $value); ?> </td>
		<td>
			<form method="post" action="productprocess.php">
				<input type="hidden" name="id" value="<?php echo $key;?>">
				<input type="submit" name="sub" value="X">
			</form>
		</td>
	</tr>
	<?php }?>	
</table>
	<strong>Total:</strong> &pound<?php echo $cart->Total(); ?> <p>
		<P><a href='cart.php?action=empty'>Clear Cart</a>
		
<?php } else { echo 'there are no products in the cart'; } ?>
	<P> <a href='index.php'>Continue Shopping</a>
	
<?php include_once('core/includes/footer.php'); ?>
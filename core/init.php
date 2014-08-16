<?php
	session_start();
	
	spl_autoload_register(function($class) {
		require_once('core/classes/'.$class.'.php');
	});
	include_once('functions.php'); 
?>
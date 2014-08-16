<?php
	function numbs($value) {
		return preg_replace("/[^1-9]/", "",$value);
	}
?>
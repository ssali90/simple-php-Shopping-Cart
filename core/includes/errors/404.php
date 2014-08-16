<h2><?php
	if($_GET) {
		foreach($_GET as $key) {
			echo ("404 page <small>".$key."</small> not found");
		}
	}
	
?></h2>
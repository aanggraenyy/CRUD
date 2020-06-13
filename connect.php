<?php
	$connection = new mysqli ("localhost","root","","crud");
	if(!$connection){ 
		echo "Connection Error!";
		exit();
	}
	?>
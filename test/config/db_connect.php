<?php 

	// connect to the database
	$conn = mysqli_connect('localhost', 'root', '', 'ifs_dc');

	// check connection
	if(!$conn){
		echo 'Connection error: '. mysqli_connect_error();
	}

?>
<?php  

	//connect to database
	$con = mysqli_connect('localhost', 'root', '', 'contact');

	//check connection
	if (!$con) {
		echo 'Connection error: ' . mysqli_connect_error();
	}

?>
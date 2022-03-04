<?php
	$serverName = "localHost";
	$userName = "KETAN588";
	$password = "53826055@Kkr";
	$database = "std_data";

	$conn = mysqli_connect($serverName, $userName, $password, $database);
	if (!$conn) {
		die("Connection failed ". mysqli_connect_error());
	}
	else{
		echo "Connected successfully <br>";
	}
?>
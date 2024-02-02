<?php
	
	$dbname = "192.0.0.1";
	$dbuser = "root";
	$dbpass = "";
	$dbhost = "localhost";

	$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

	if(!$conn){
		echo $conn -> error;
		exit;
	}


	

?>
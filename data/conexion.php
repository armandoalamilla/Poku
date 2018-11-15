<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "poku";


	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error)
	{
		header('HTTP/1.1 500 Bad connection to Database');
		die("The server is down, we couldn't establish the DB connection");
	}
	else{
		
	}
?>
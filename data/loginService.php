<?php
	header('Accept: application/json');
	header('Content-type: application/json');

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
	else
	{
		$uEmail = $_POST["uEmail"];
		$uPassword = $_POST["uPassword"];

		$sql = "SELECT * FROM admin WHERE email='$uEmail' AND pass='$uPassword'";
		
		$result = $conn->query($sql);

		if ($result->num_rows > 0)
		{
			// Guardar cookie
			$remember = $_POST["remember"];
			if ($remember == "true")
			{
				setcookie("email", $uEmail, time() + 3600*100);
				setcookie("password", $uPassword, time() + 3600*100);
				
			}

			while ($row = $result->fetch_assoc())
			{
				$response = array("email" => $row["email"]);
				
				// Abrir y guardar datos en la sesion
				@session_start();
				$_SESSION["username"] = $row["username"];
				$_SESSION["email"] = $row["email"];
			}

			echo json_encode($response);
		}
		else
		{
			header('HTTP/1.1 406 User not found');
			die("Wrong credentials provided!");
		}
	}
?>





















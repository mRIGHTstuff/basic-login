<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Bootstrap 101 Template</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<style>
		body {
			margin: 25px;
			color: ;
			background-color: ;
		}
	</style>
</head>

<body>

	<?php
	error_reporting(E_ALL);
	$username = 'root';
	$password = 'peekaboo';
	$server = 'localhost';
	$db = 'test';

	$conn = new mysqli($server, $username, $password, $db);

	if ($conn->connect_error) {
		echo mysqli_connect_error();
		exit;
	}

	$usr = $_POST['user'];
	$usrps = $_POST['userpass'];
	$usrpsck = $_POST['userpasscheck'];
	$hideUsrps = password_hash($_POST['userpass'], PASSWORD_BCRYPT);

	$result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$usr'");

	if (mysqli_num_rows($result) >=1) {
		echo "<span class=\"glyphicon glyphicon-remove-circle\"></span> That username already exists<br>";
		exit;
	} else {
		echo "<span class=\"glyphicon glyphicon-ok-circle\"></span> Username Free<br>";
	}

	if (strlen($usr) <= 10) {
		echo "<span class=\"glyphicon glyphicon-ok-circle\"></span> Username Length OK<br>";
	} else {
		echo "<span class=\"glyphicon glyphicon-remove-circle\"></span> Username invalid<br>";
		exit;
	}

	if (preg_match('/[A-Za-z]/', $usrps) && preg_match('/[0-9]/', $usrps)) {
		echo "<span class=\"glyphicon glyphicon-ok-circle\"></span> Password OK<br>";
	} else {
		echo "<span class=\"glyphicon glyphicon-remove-circle\"></span> Password must contain a letter and number<br>";
		exit;
	}

	if (password_verify($usrpsck, $hideUsrps)) {
		echo "<span class=\"glyphicon glyphicon-ok-circle\"></span> Password matches<br>";
	} else {
		echo "<span class=\"glyphicon glyphicon-remove-circle\"></span> Password must match<br>";
		exit;
	}

	if (strlen($usrps) >= 8) {
		echo "<span class=\"glyphicon glyphicon-ok-circle\"></span> Password long enough<br>";
	} else {
		echo "<span class=\"glyphicon glyphicon-remove-circle\"></span> Password must be at least 8 characters<br>";
		exit;
	}

	$sql = "INSERT INTO users (username, password) VALUES ('" . $usr . "', '" . $hideUsrps ."')";
	mysqli_query($conn, $sql);


	$conn->close();



// header("Location: http://localhost:8000/tasks.php");
// exit();

	?>

	<a href="users.html">Login</a>
</body>
</html>
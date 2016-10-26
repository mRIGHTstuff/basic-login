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

$result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$usr'");
$row = mysqli_fetch_array($result);

if (password_verify($usrps, $row['password'])) {
	echo "Login successful";
} else {
	echo "Login failed";
}

?>
<?php
	// var_dump($_POST);
	require_once '../Auth.php';
	require_once '../Input.php';

	session_start();
	// re-store the username sent from login page
	// $username = $_SESSION['LOGGED_IN_USER'];
	$username = Auth::user();

	// Don't allow access to authorization page if user is not logged in
	// if(isset($_SESSION['LOGGED_IN_USER'])){
	if(Auth::check()){
		echo "Welcome $username!";
	} else {
		header("Location: login2.php");
		exit();
	};

?>

<!DOCTYPE html>
<html>
<head>
	<title>POST Results</title>
</head>
<body>
	<h2>Access Authorized</h2>
	<form action="logout2.php">
		<input type='submit' value="Logout">
	</form>
</body>
</html>
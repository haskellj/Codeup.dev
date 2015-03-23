<?php
	var_dump($_POST);
	
	session_start();
	$username = $_SESSION['LOGGED_IN_USER'];

	if(isset($_SESSION['LOGGED_IN_USER'])){
		echo $username;
	} else {
		header("Location: login.php");
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
	<form action="logout.php">
		<input type='submit' value="Logout">
	</form>
</body>
</html>
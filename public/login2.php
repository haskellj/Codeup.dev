<?php
	// Required class
	require_once '../Auth.php';

	// Start a session for the page
	session_start();

	// If user is already logged in, redirect to authorization page and don't run rest of PHP
	if(Auth::check()){
		header("Location: authorized2.php");		// header() is a redirect function
		exit();
	}
	
	// If user is not logged in, ask for credentials
	$username = isset($_POST['username']) ? $_POST['username'] : '';
	$password = isset($_POST['password']) ? $_POST['password'] : '';
	$message = '';

	if($_POST) {
		// if($username == 'guest' && $password == 'password'){
			// clear array of any data from previous sessions
			// $_SESSION = array();
			// // store user's username to pass to next page
			// $_SESSION['LOGGED_IN_USER'] = $username;
		Auth::attempt($username, $password);

		if(isset($_SESSION['LOGGED_IN_USER'])){
			// redirect to authorization page and exit() any remaining PHP script
			header("Location: authorized2.php");
			exit();
		} else {
			$message = "Wrong username or password";
		}
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>POST,Session,Class</title>
</head>
<body>
	<? if(!empty($message)): ?>
		<h1><?= $message; ?></h1>
	<? endif; ?>
	<form method="POST" action="login2.php">
		<p>
			<label for="name">Username: </label>
			<input type="text" name="username" id="name">
		</p>
		<p>
			<label for="pswd">Password: </label>
			<input type="password" name="password" id="pswd">
		</p>
		<button type="submit">Submit</button>
	</form>
</body>
</html>
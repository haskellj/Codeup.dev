<?php
	
	// Start a session for the page
	session_start();

	// If user is already logged in, redirect to authorization page
	if(isset($_SESSION['LOGGED_IN_USER'])){
		header("Location: authorized.php");		// header() is a redirect function
		exit();
	}
	
	// If user is not logged in, ask for credentials
	$username = "guest";
	$password = "password";
	$message = "";

	if (isset($_POST['username']) && isset($_POST['password'])){
		$inputName = $_POST['username'];
		$inputPswd = $_POST['password'];

		if($inputName != $username || $inputPswd != $password){
			$message = "Wrong username or password.";
		} else {
			// Initialize a session
			// session_start();
			// clear array of any data from previous sessions
			$_SESSION = array();
			// store user's username to pass to next page
			$_SESSION['LOGGED_IN_USER'] = $username;

			// redirect to authorization page and exit() any remaining PHP script
			header("Location: authorized.php");		// header() is a redirect function
			exit();
		}
	} else {
			$message = "Please enter your username & password.";
		};
?>
<!DOCTYPE html>
<html>
<head>
	<title>POST Request</title>
</head>
<body>
	<h3><?php echo $message; ?></h3>
	<form method="POST" action="login.php">
		<p>
			<label>Username: </label>
			<input type="text" name="username">
		</p>
		<p>
			<label>Password: </label>
			<input type="password" name="password">
		</p>
		<button type="submit">Submit</button>
	</form>
</body>
</html>
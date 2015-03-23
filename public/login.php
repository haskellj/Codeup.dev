<?php
	$username = "guest";
	$password = "password";
	$message = "";

	if(isset($_POST['username']) && isset($_POST['password'])){
		$inputName = $_POST['username'];
		$inputPswd = $_POST['password'];

		if($inputName != $username || $inputPswd != $password){
			$message = "Wrong username or password.";
		} else {
			header("Location: authorized.php?");		// header() is a redirect function
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
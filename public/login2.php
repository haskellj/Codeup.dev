<?php

	$username = isset($_POST['username']) ? $_POST['username'] : '';
	$password = isset($_POST['password']) ? $_POST['password'] : '';
	$message = '';

	if($_POST) {
		if($username == 'guest' && $password == 'password'){
			header("Location: authorized.php");
		} else {
			$message = "Wrong username or password";
		}
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>POST Request</title>
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
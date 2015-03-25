<?php
	require_once '../Auth.php';
	
	// code for this function came directly from PHP docs:
	// http://php.net/session_destroy
	function endSession()
	{
	    // // Unset all of the session variables.
	    // $_SESSION = array();

	    // // If it's desired to kill the session, also delete the session cookie.
	    // // Note: This will destroy the session, and not just the session data!
	    // if (ini_get("session.use_cookies")) {
	    //     $params = session_get_cookie_params();
	    //     setcookie(session_name(), '', time() - 42000,
	    //         $params["path"], $params["domain"],
	    //         $params["secure"], $params["httponly"]
	    //     );
	    // }

	    // // Finally, destroy the session and redirect user back to login page.
	    // session_destroy();
	    Auth::logout();
	    header("Location: login2.php");
	}

	endSession();

?>
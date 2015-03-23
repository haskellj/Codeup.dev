<?php
// start the session (or resume an existing one)
// this function must be called before trying to set of get any session data!
session_start();

// get the current session id
$sessionId = session_id();

// initialize view count variable
$viewCount = 0;

// check to see if we are resetting the session 
// or if we are resetting the counter
// or if we have a view count being tracked in the session
if (!empty($_POST['resetSession'])) {
    // end the current session
    endSession();

    // reload this page
    header('Location: session-example.php');
    exit();
} elseif (!empty($_POST['resetCounter'])) {
    $_SESSION['VIEW_COUNT'] = 0;
} elseif (!empty($_SESSION['VIEW_COUNT'])) {
    // we found one, use it instead of the default
    $viewCount = $_SESSION['VIEW_COUNT'];
}

// increment the counter
$viewCount++;

// store the new value to the session
$_SESSION['VIEW_COUNT'] = $viewCount;

// code for this function came directly from PHP docs:
// http://php.net/session_destroy
function endSession()
{
    // Unset all of the session variables.
    $_SESSION = array();

    // If it's desired to kill the session, also delete the session cookie.
    // Note: This will destroy the session, and not just the session data!
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    // Finally, destroy the session.
    session_destroy();
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Session Example</title>
</head>
<body>
    Session Id: <?php echo $sessionId; ?><br>
    View Count: <?php echo $viewCount; ?><br>
     <form method="POST">
        <input type="hidden" name="resetSession" value="reset">
        <input type="submit" value="Reset Session">
    </form>
    <form method="POST">
        <input type="hidden" name="resetCounter" value="reset">
        <input type="submit" value="Reset Counter">
    </form>
    <form action="session-example.php">
    	<input type='submit' value="Refresh Page">
    </form>
</body>
</html>
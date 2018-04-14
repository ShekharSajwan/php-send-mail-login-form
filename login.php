<?php
/* User login process, checks if user exists and password is correct */

// Escape email to protect against SQL injections
$email = $mysqli->escape_string($_POST['user-login-email']);
$result = $mysqli->query("SELECT * FROM user_info WHERE Email='$email'");

if ( $result->num_rows == 0 )
{ // User doesn't exist
    $_SESSION['message'] = "User with that email doesn't exist!";
    header("location: error.php");
}
else
{
   // User exists
    $user = $result->fetch_assoc();

    if ( password_verify($_POST['user-login-password'], $user['Password']) )
    {

        $_SESSION['user-email'] = $user['Email'];
        $_SESSION['user-first-name'] = $user['Firstname'];
        $_SESSION['user-last-name'] = $user['Lastname'];
        $_SESSION['active'] = $user['Active'];

        // This is how we'll know the user is logged in
        $_SESSION['logged_in'] = true;

        header("location: profile.php");
    }
    else {
        $_SESSION['message'] = "You have entered wrong password, try again!";
        header("location: error.php");
    }
}


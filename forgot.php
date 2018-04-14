<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
/* Reset your password form, sends reset.php password link */
require 'db.php';

session_start();

// Check if form submitted with method="post"
if ( $_SERVER['REQUEST_METHOD'] == 'POST' )
{
    $email = $mysqli->escape_string($_POST['email']);
    $result = $mysqli->query("SELECT * FROM user_info WHERE Email='$email'");

    if ( $result->num_rows == 0 ) // User doesn't exist
    {
        session_unset($_SESSION['message']);
        $_SESSION['message'] = "User with that email doesn't exist!";
        header("location: error.php");
    }
    else
    { // User exists (num_rows != 0)

        $user = $result->fetch_assoc(); // $user becomes array with user data

        $email = $user['Email'];
        $hash = $user['Hash'];
        $first_name = $user['Firstname'];

        // Session message to display on success.php
        $_SESSION['message'] = "<p>Please check your email <span>$email</span>"
            . " for a confirmation link to complete your password reset!</p>";

        // Send registration confirmation link (reset.php)
        //send registration confirm mail
        $mail = new PHPMailer(true);
        // Passing `true` enables exceptions
        $mail->IsSMTP();
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        try
        {
            //Server settings
            $mail->SMTPDebug = 2;

            // Set mailer to use SMTP

            $mail->Host = 'smtp.gmail.com';
            // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                                  // Enable SMTP authentication
            $mail->Username = 'shekhar.wri133@webreinvent.com';     // SMTP username
            $mail->Password =  'asdf@123';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('shekhar.wri133@webreinvent.com', 'Account verification Team');
            $mail->addAddress($email, $first_name);
            // Name is optional
            $mail->addReplyTo('shekhar.wri133@webreinvent.com', 'valuable reply');

            //Content
            $mail->isHTML(true);
            // Set email format to HTML
            $mail->Subject = '\'Password Verification\'';
            $mail->Body    =  ' Hello '.$first_name.',<br> 
 
             
        You have requested password reset! 
 
        Please click this link to reset your password: 
 
        http://localhost/shekhar/PHP_learning/PHP_training/PHPbasicsPracticalLoginSystem/reset.php?email='.$email.'&hash='.$hash;
            $mail->send();
            echo 'Message has been sent';
        }
        catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }

    }

    header("location: success.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Reset Your Password</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css?v=1.2">
</head>

<body>

<div class="container">
    <div class="middle-content">
        <div class="well-lg">
            <div class="form">

                <h1>Reset Your Password</h1>

                <form action="forgot.php" method="post">
                    <div class="field-wrap">
                        <label>
                            Email Address<span class="req">*</span>
                        </label>
                        <input type="email" class="form-control" required autocomplete="off" name="email"/>
                    </div>
                    <button class="btn btn-info btn-lg"/>Reset</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>
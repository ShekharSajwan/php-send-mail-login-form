<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

//set user info in session
$_SESSION['user-email']=$_POST['user-email'];
$_SESSION['user-first-name']=$_POST['user-first-name'];
$_SESSION['user-last-name']=$_POST['user-last-name'];

//prevent sql injection
$first_name=$mysqli->escape_string($_POST['user-first-name']);
$last_name=$mysqli->escape_string($_POST['user-last-name']);
$user_email=$mysqli->escape_string($_POST['user-email']);
$user_password=$mysqli->escape_string(password_hash($_POST['user-password'], PASSWORD_BCRYPT));
$hash=$mysqli->escape_string(md5(rand(0,1000)));

//check if user already exists
$result=$mysqli->query("SELECT * FROM user_info WHERE Email = '$user_email'") or die($mysqli->error());

if($result->num_rows > 0)
{
    $_SESSION['message']='user with this email is already exists';
    header("location: error.php");
}
else
    //save a data to database
{
    $sql= "INSERT INTO user_info(Firstname,Lastname,Email,Password,Hash)   
                        VALUES ('$first_name','$last_name','$user_email','$user_password','$hash')";

    //add user to database
    if ($mysqli->query($sql))
    {
        //until user active the account
        $_SESSION['active']=0;
        //so we know the user
        $_SESSION['logged_in'] = true;

        $_SESSION['message'] = "Confirmation link has been sent to $user_email,please verify your account by  
                                 clicking on the link in the message!";

         
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
            $mail->addAddress($user_email, $first_name);
            // Name is optional
            $mail->addReplyTo('shekhar.wri133@webreinvent.com', 'valuable reply');

            //Content
            $mail->isHTML(true);
            // Set email format to HTML
            $mail->Subject = '\'Account Verification \'';
            $mail->Body    =  ' Hello '.$first_name.',
 
        Thank you for signing up! 
 
        Please click this link to activate your account: 
 
         http://localhost/php/php-send-mail-login-form/verify.php?email='.$user_email.'&hash='.$hash;

            $mail->send();
            echo 'Message has been sent';
        }
        catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }

        header("location: profile.php");

    }
    else
    {
        $_SESSION['message']='Registration failed';
        header("location: error.php");
    }
}


?>
<?php
/* The password reset form, the link to this page is included
   from the forgot.php email message
*/
require 'db.php';
session_start();

// Make sure email and hash variables aren't empty
if( isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash']) )
{
    $email = $mysqli->escape_string($_GET['email']);
    $hash = $mysqli->escape_string($_GET['hash']);

    // Make sure user email with matching hash exist
    $result = $mysqli->query("SELECT * FROM user_info WHERE Email='$email' AND Hash='$hash'");

    if ( $result->num_rows == 0 )
    {
        $_SESSION['message'] = "You have entered invalid URL for password reset!";
        header("location: error.php");
    }
}
else {
    $_SESSION['message'] = "Sorry, verification failed, try again!";
    header("location: error.php");
}
?>
<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title>Reset Your Password</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css?v=1.1">
</head>

<body>

<div class="container">
    <div class="middle-content">
        <div class="well-lg">
          <div class="form ">

    <h1>Choose Your New Password</h1>

    <form action="reset_password.php"  method="post" class="form">

        <div class="field-wrap form-group">
            <label>
                New Password<span class="req">*</span>
            </label>
            <input type="password" required name="newpassword"  class="form-control password-value" value="" pattern=".{6,}" title="Six or more characters" autocomplete="off"/>
        </div>

        <div class="field-wrap form-group">
            <label>
                Confirm New Password<span class="req">*</span>
            </label>
            <input type="password" required name="confirmpassword" class="form-control confirm-password-value"  value="" pattern=".{6,}" title="Six or more characters"  autocomplete="off"/>
           <div class="confirm-pass-error">
               <span class="text text-danger">oops! password field and confirm password field does not match..</span>
           </div>
        </div>

        <!-- This input field is needed, to get the email of the user -->
        <input type="hidden" name="email" class="form-control" value="<?= $email ?>">
        <input type="hidden" name="hash" class="form-control" value="<?= $hash ?>">

        <button class="btn btn-info center-block" id="reset-pass-button" />Apply</button>

    </form>

</div>
        </div>
    </div>
</div>
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jsfile.js?v=<?php echo include 'cache-burst.php'; ?>"></script>

</body>
</html>

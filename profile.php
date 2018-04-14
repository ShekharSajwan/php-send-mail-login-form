<?php
/* Displays user information and some useful messages */
session_start();

// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != 1 ) {
    $_SESSION['message'] = "You must log in before viewing your profile page!";
    header("location: error.php");
}
else {
    // Makes it easier to read
    $first_name = $_SESSION['user-first-name'];
    $last_name = $_SESSION['user-last-name'];
    $email = $_SESSION['user-email'];
    $active = $_SESSION['active'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Welcome <?= $first_name.' '.$last_name ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css?v=1.1">
</head>

<body>

<div class="container">
    <div class="middle-content">
        <div class="well-lg">

       <div class="form">

                <p> <h1 id="center-item-head" align="center">Welcome</h1></p>

                <p>
                    <?php

                    // Display message about account verification link only once
                    if ( isset($_SESSION['message']) )
                    {

                        echo '<div class="alert alert-warning center-block">'
                                   .$_SESSION['message'].
                             '</div>';

                        // Don't annoy the user with more messages upon page refresh
                        unset( $_SESSION['message'] );
                    }

                    ?>
                </p>

                <?php

                // Keep reminding the user this account is not active, until they activate
                if ( !$active )
                {
                  echo '<div class="alert alert-warning center-block">
                          Account is unverified, please confirm your email by clicking
                          on the email link on your email account!
                     </div>';
                }

                ?>
           <hr>
                <h2><?php echo $first_name.' '.$last_name; ?></h2>

                <p id="email-user" align="center" class="text text-success"><?= $email ?></p>

                <a href="logout.php" class="btn center-block">
                    <button class="btn btn-info center-block" name="logout"/>Log Out</button>
                </a>

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

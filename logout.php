<?php
/* Log out process, unsets and destroys session variables */
session_start();
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Error</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
     <link rel="stylesheet" href="css/style.css?v=1.1">
</head>
<body>
<div class="container">
    <div class="middle-content">
        <div class="well-lg">
            <div class="form">
                <h1>Thanks for stopping by</h1>

                <p><?= 'You have been logged out!'; ?></p>

                <a href="index.php" class="btn center-block">
                    <button class="btn btn-info center-block" name="home"/>Home</button>
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
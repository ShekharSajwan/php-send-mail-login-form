<?php
/* Displays all error messages */
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Error</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <?php include 'cache-burst.php' ?>;
    <link rel="stylesheet" href="css/style.css?v=<?php echo getUniqueHashCode(); ?>">
</head>
<body>

<div class="container">
    <div class="middle-content">
        <div class="well-lg">
            <div class="form">
                <h1 id="Error-msg">Error</h1>

                <?php
                if( isset($_SESSION['message']) AND !empty($_SESSION['message']) ):
                    echo "<div class='text-warning'><p>".$_SESSION['message']."</p></div>";
                else:
                    header( "location: index.php" );
                endif;
                ?>

                <a href="index.php"><button class="button button-block"/>Home</button></a>
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

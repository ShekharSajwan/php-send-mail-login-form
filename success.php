<?php
/* Displays all successful messages */
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Success</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css?v=1.1">
</head>
<body>

<div class="container">
    <div class="middle-content">
        <div class="well-lg">

          <div class="form">
            <h1 class="text text-success"><?= ''; ?></h1>
            <p>
            <?php
            if( isset($_SESSION['message']) AND !empty($_SESSION['message']) ):
                echo $_SESSION['message'];
            else:
                header( "location: index.php" );
            endif;
            ?>
            </p>
            <a href="index.php" class="btn center-block"><button class="btn btn-info center-block"/>Home</button></a>
         </div>
       </div>
   </div>
 </div>
</body>
</html>

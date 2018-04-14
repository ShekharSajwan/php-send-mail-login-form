<?php
require 'db.php';
session_start();
@session_unset($_SESSION['messages']);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Welcome</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<?php include 'cache-burst.php'; ?>

    <link rel="stylesheet" href="css/style.css?v=<?php echo getUniqueHashCode(); ?>">
</head>
<?php

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	if(isset($_POST['login']))
	{
		require 'login.php';
	}
	else
	   if (isset($_POST['register']))
		{
		require 'register.php';
	    }
}
 
?>
<body>
 
<div class="container">
	<div class="middle-content">
		<div class="well-lg">
			<header>
				<h3>Welcome</h3>
			</header>
			<ul class="nav nav-pills nav-justified">
				<li class="active"><a data-toggle="pill" href="#register-form">Register</a></li>
				<li><a data-toggle="pill" href="#login-form">login</a></li>
			</ul>

			<div class="tab-content">
				<div id="register-form" class="tab-pane fade in active">
					<h2>Sign Up</h2>
                   <div class="form">
					   <form class="form" id="reg_form" method="POST" action="index.php">
						   <div class="form-group">
                              <label for="first-name">First Name:</label>
                              <input type="text" name="user-first-name" required  class="user-first-name form-control" pattern="[a-zA-Z_.-]*" title="Only Alphabetical value allowed" placeholder="Enter your first name">

                              <div class="user-first-name-error">
                              	<span class="text text-danger">
                              	Name should be atleast 5 char & space not allowed</span>
                              </div>
						   </div>

                              

						    <div class="form-group">
                              <label for="last-name">Last Name:</label>
                              <input type="text" name="user-last-name"
                               pattern="[a-zA-Z_.-]*" title="Only Alphabetical value allowed" required class="form-control user-last-name" placeholder="Enter your last name" >

                              <div class="user-last-name-error">
                              	<span class="text text-danger">
                              	Do not use spaces</span>
                              </div>
						   </div>

						    <div class="form-group">
                              <label for="email">Email:</label>
                              <input type="email" name="user-email" required  class="form-control user-email" placeholder="someone@gmail.com"> 

                              <div class="user-email-error">
                              	<span class="text text-danger">
                              	Make sure your email should be correct formet</span>
                              </div>
						    </div>

						    <div class="form-group">
                              <label for="password">Password:</label>
                              <input type="Password" name="user-password" required  class="form-control" pattern=".{6,}" title="Six or more characters" placeholder="Enter your Password">
						   </div>
						   <div class="register-btn">
							   <button class="btn btn-lg btn-success register " type="submit" name="register">Register</button>
						   </div>

					   </form>
				   </div>
				</div>
				<div id="login-form" class="tab-pane fade">
					<h2>Login</h2>
					<div class="form">
						<form class="form" id="login_form" method="POST" action="index.php">
							<div class="form-group">
								<label for="login-email">Email:</label>
								<input type="email" name="user-login-email"  required class="form-control user-login-email" placeholder="Enter your Email">

								<div class="user-login-email-error">
                              	<span class="text text-danger">
                              	Make sure your email should be correct formet</span>
                              </div>
								 
							</div>

							<div class="form-group">
								<label for="login-password">Password:</label>
								<input type="Password" name="user-login-password" required  class="form-control" pattern=".{6,}" title="Six or more characters"  placeholder="Enter your Password">
							</div>

							<div class="form-group">
								<a href="forgot.php">forgot password?</a>
							</div>

							<div class="login-btn">
								<button class="btn btn-lg btn-success" type="submit" name="login">login</button>
							</div>

						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jsfile.js?v=<?php echo getUniqueHashCode(); ?>"></script>

</body>
</html>
 
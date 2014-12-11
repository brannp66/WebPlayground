<?php
session_start();
require_once 'classes\login.php';
$login = new Login();

if(isset($_POST)) {
	if(isset($_POST['logout'])) {
		$login->logout();
	}

	//Did the user click create
	if (isset($_POST['create'])) {
		header('location: createAccount.php');
	}
	// Did the user enter a username and password
	if (isset($_POST['username']) && isset($_POST['password'])) {
		$response = $login->validate_user($_POST['username'], $_POST['password']);
  }
}
?>

<!doctype html>
<html>
	<head>
		<title>Welcome</title>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script src="/js/vendor/modernizr.js"></script>
		<script src="js/foundation.min.js"></script>
		<script src="js/foundation/foundation.alert.js"></script>

		<link rel='stylesheet' type='text/css' href='css/foundation.css' />
		<link rel='stylesheet' type='text/css' href='css/style.css' />
	</head>
	<body>
		<div class='prompt'>
			<h1>Welcome</h1>
			<div class='input'>
				<div class='containter'>
					<form method='post' action='' onchange="return validateForm();"/>
						<?php 
							if(isset($response)) {
							  echo "<div data-alert class='alert-box alert radius'>";
							  echo $response;
							  echo "<a href='#' class='close'>&times;</a></div>";
							}
						?>
						<input type='text' name='username' placeholder='Username' />
						<input type='password' name='password' placeholder='Password' />
						<!-- <input type='checkbox' name='keep' />Keep me signed in -->
						<input type='submit' name='login' value='Sign In' class='button' />
						<input type='submit' name='create' value='Create Account' class='button'/>
					</form>
					<a href='forgotPassword.php'>Forgot Password?</a>
				</div>
			</div>
		</div>
		<script>$(document).foundation();</script>
	</body>
</html>
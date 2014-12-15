<?php

require_once 'MongoDB.php';

class Login {

	// Checks for username and password in database 
	// redirects to home page if logged in
	function validate_user($user, $pwd) {
		$mongo = new myMongoDB();
		$verify = $mongo->verify_login($user, $pwd);// will need to add hashing
		if($verify) {
			$_SESSION['loggedIn'] = 1;
			header("location: home.php");
		}
		else {
			return "Wrong username and/or password";
		}
	}

	//logs user out and destroys session
	function logout() {
		if(isset($_SESSION['loggedIn'])) {
			unset($_SESSION['loggedIn']);

			if(isset($_COOKIE[session_name()])) {
			 setcookie(session_name(), '', time() - 100000);
			 session_destroy();
			}
		}
	}

	//if user is not logged in, redirected to index.php
	function confirm_member() {
		session_start();
		if($_SESSION['loggedIn'] != 1) {
			header("location: index.php");
		}
	}

	//checks if username is available
	//returns true if available
	//returns false if not available
	function check_username_availability($user) {
		$mongo = new myMongoDB();
		$inDatabase = $mongo->verify_user($user);

		if($inDatabase) {
			return false;
		}
		else {
			return true;
		}
	}

	//adds user to the database
	function add_user($user, $pwd, $email) {
		$mongo = new myMongoDB();
		$mongo->add_user($user, $pwd, $email);
	}
}

?>
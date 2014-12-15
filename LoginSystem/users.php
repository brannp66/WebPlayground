<?php

require_once 'classes\login.php';
$login = new Login();

if(isset($_POST['userCheck'])) {
	$isAvailable = $login->check_username_availability($_POST['userCheck']);

	if($isAvailable) {
		echo true;
	}
	else {
		echo false;
	}
} 

?>
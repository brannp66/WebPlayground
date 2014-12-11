<?php

include_once "constants.php";
include "../includes/constants.php";

class myMongoDB {
	private $db;
	private $conn;

	//Sets up connection to database using constant DB_NAME
	function __construct() {
		$this->conn = new MongoClient() or die ('Could not connect to database');
		$this->db = $this->conn->selectDB(DB_NAME);
	}

	//Verifies login credentials
	//returns true if a match is found,
	//returns false if no match
	function verify_username_and_password($user, $pwd) {
		$collection = $this->db->Users;
		$result = $collection->findOne(array('username' => $user,
																				 'password' => $pwd)); //need to add hashing
		
		if($result) {
			return true;
		}
		else {
			return false;
		}
	}

	// checks if a user is in the database
	// returns true if user is in database
	// returns false if user is not in database
	function check_for_user($user) {
		$collection = $this->db->Users;
		$result = $collection->findOne(array('username' => $user));

		if($result) {
			return true;
		}
		else {
			return false;
		}
	}

	function add_user($user, $password, $email) {
		$collection = $this->db->Users;
		$result = $collection->insert(array('username'=>$user,
																				'password'=>$password,
																				'email'=>$email));
	}
}


?>
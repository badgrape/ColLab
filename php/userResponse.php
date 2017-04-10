<?php

require("userManage.php");
include("debug.php");

// Prepare a response to be sent when the page is requested

// Retrieve the Request Data
$reqJson = file_get_contents('php://input');

// Convert Request JSON data to associative Object
$reqPhp = json_decode($reqJson, true);

if (($reqPhp[2]['value']) == "login") {
	
// Log in

	try {

	require_once("dbConnect.php");

	$email = htmlentities($reqPhp[0]['value']);

		if (!userExists($email)) {
			echo "No such user";
		}

		else {

			$password = htmlentities($reqPhp[1]['value']);

			$salt = getPassword($email)['salt'];
			$hash = getPassword($email)['hash'];

			if (encrypt($salt, $password) != $hash) {
				echo "Access Denied.";
			}

			else {
				session_start();
				$_SESSION['user'] = getUser($email);
				$user = json_encode($_SESSION['user']);
				echo $user;
			}

		}

	}

	catch(PDOException $e) {echo $e->getMessage();}

/* Insert new user
	try {
		require_once("dbConnect.php");
		addUser($username, $email, encrypt($password));
	}
	
	catch(PDOException $e) {echo $e->getMessage();}
	
	// Query database
	try {
		$result = getUsers();
	}
	
	catch(PDOException $e) {echo $e->getMessage();}
	
	// Convert dbase results to JSON string
	$users = json_encode($result);
	
	//Send JSON string back to requesting page
	echo $users;

 */

}

else {echo "No data.";}

?>

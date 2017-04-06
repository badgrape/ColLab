<?php

require("dbUtils.php");
include("debug.php");

// Prepare a response to be sent when the page is requested

// Retrieve the Request Data
$reqJson = file_get_contents('php://input');

// Convert Request JSON data to associative Object
$reqPhp = json_decode($reqJson, true);

if (isset($reqPhp['submit'])) {
	
	$username = htmlentities($reqPhp['username']);
	$email = htmlentities($reqPhp['email']);
	$password = htmlentities($reqPhp['password']);

	// Insert new user
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

}

else {echo "No data.";}

?>

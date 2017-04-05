<?php

require("dbUtils.php");
include("debug.php");

// Prepare a response to be sent when the page is requested

// Retrieve the Request Data
$reqRaw = file_get_contents('php://input');

// Convert Request JSON data to associative Object
$reqJson = json_decode($reqRaw, true);

$username = htmlentities($reqJson['username']);
$email = htmlentities($reqJson['email']);
$password = htmlentities($reqJson['password']);
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

?>

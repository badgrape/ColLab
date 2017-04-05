<?php

require_once("Dbase.php");
include("debug.php");

//JSON string
$peopleJSON = '[
	{"name":"Jim", "email":"germ@badgrape.net"},
	{"name":"Emily", "email":"brain@badgrape.net"},
	{"name":"Jake", "email":"dirtyflash@badgrape.net"}
]';

echo $peopleJSON;

// Convert JSON string to array
$peoplePHP = json_decode($peopleJSON, true);

printObject($peoplePHP);

// Query database
try {
	$query = new Dbase("badgrape", "jim", "s3ns3nn0s3n");	
	$result = $query->getUsers();
}

catch(PDOException $e) {
	echo $e->getMessage();
}

printObject($result);

// Convert dbase results to JSON string
$peopleJaySun = json_encode($result);
echo $peopleJaySun;

?>

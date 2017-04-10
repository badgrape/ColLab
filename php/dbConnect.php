<?php

$db = "collab";
$user = "root";
$pass ="";
//$user = "jim";
//$pass = "s3ns3nn0s3n";

$pdo = new PDO ("mysql:host=localhost;dbname=$db", $user, $pass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>

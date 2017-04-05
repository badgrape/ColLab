<?php

$db = "badgrape";
$user = "root";
$pass = "";

$pdo = new PDO ("mysql:host=localhost;dbname=$db", $user, $pass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>

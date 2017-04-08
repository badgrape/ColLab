<?php

function printObject($object) {
	echo "<pre>";
	print_r($object);
	echo "</pre>";
}

function getUsers() {
	GLOBAL $pdo;
	$sql = "select fname, lname, email from users";
	$stmt = $pdo->query($sql);
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $result;
}

?>

<?php

function getUsers($pdo) {
	GLOBAL $pdo;
	$sql = "select name, email from users";
	$stmt = $pdo->query($sql);
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $result;
}

?>

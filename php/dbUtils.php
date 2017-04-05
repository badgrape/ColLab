<?php

function getUsers() {
	GLOBAL $pdo;
	$sql = "select name, email from users";
	$stmt = $pdo->query($sql);
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $result;
}

function addUser($uname, $email, $password) {
	GLOBAL $pdo;

	$sql = "INSERT INTO users (name, email, password)
	VALUES (:name, :email, :password)";
	$stmt = $pdo->prepare($sql);

	$stmt->bindParam(':name', $uname);
	$stmt->bindParam(':email', $email);
	$stmt->bindParam(':password', $password);

	$stmt->execute();

}

function encrypt($pass) {
	$salt = "RTui%b*B29";
	$saltedPass = $salt.$pass;
	$token = hash('ripemd128', $saltedPass);
	return $token;
}

?>

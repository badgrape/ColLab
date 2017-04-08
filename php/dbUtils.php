<?php

function getSalt($string, $max) {
	if (strlen($string) == $max) {
		return $string;
	}

	else {
		$string .= chr(rand(0, 127));
		return getSalt($string, $max);
	}
}

function encrypt($salt, $pass) {
	$saltedPass = $salt . $pass;
	$token = hash('ripemd128', $saltedPass);
	return $token;
}

function addUser($userid, $fname, $lname, $email, $password) {
	GLOBAL $pdo;

	$salt = getSalt("", 12);
	$hash = encrypt($salt, $password);

	$sql = "INSERT INTO users (userid, fname, lname, email, salt, hash)
		VALUES (:userid, :fname, :lname, :email, :salt, :hash)";
	$stmt = $pdo->prepare($sql);

	$stmt->bindParam(':userid', $userid);
	$stmt->bindParam(':fname', $fname);
	$stmt->bindParam(':lname', $lname);
	$stmt->bindParam(':email', $email);
	$stmt->bindParam(':salt', $salt);
	$stmt->bindParam(':hash', $hash);

	$stmt->execute();
}

?>

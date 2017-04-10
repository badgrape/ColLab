<?php

// Registration

function addUser($fname, $lname, $role, $email, $password) {
	GLOBAL $pdo;

	$salt = getSalt("", 12);
	$hash = encrypt($salt, $password);

	$sql = "insert into users (fname, lname, role, email, salt, hash)
		values (:fname, :lname, :role, :email, :salt, :hash)";
	$stmt = $pdo->prepare($sql);

	$stmt->bindParam(':fname', $fname);
	$stmt->bindParam(':lname', $lname);
	$stmt->bindParam(':role', $role);
	$stmt->bindParam(':email', $email);
	$stmt->bindParam(':salt', $salt);
	$stmt->bindParam(':hash', $hash);

	$stmt->execute();
}

// Password encryption

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

// Log in

function matches($string01, $string02) {
	if ($string01 == $string02) {
		return true;
	}

	else {
		return false;
	}
}

function userExists($email) {
	GLOBAL $pdo;

	$sql = "select userid from users where email = :email";
	$stmt = $pdo->prepare($sql);

	$stmt->bindParam(':email', $email);

	$stmt->execute();

	if ($stmt->fetch(PDO::FETCH_ASSOC) == 0) {
		return false;
	}
	else {
		return true;
	}
}


function getPassword($email) {

	GLOBAL $pdo;

	$sql = "select salt, hash from users where email = :email";
	$stmt = $pdo->prepare($sql);

	$stmt->bindParam(':email', $email);

	$stmt->execute();

	$result = $stmt->fetch(PDO::FETCH_ASSOC);

	return $result;

}

// Forgot password

function requestedBy($fname, $lname, $email) {
	GLOBAL $pdo;

	$sql = "select userid from users where lower(fname) = lower(:fname)
		and lower(lname) = lower(:lname) and lower(email) = lower(:email)";
	$stmt = $pdo->prepare($sql);

	$stmt->bindParam(':fname', $fname);
	$stmt->bindParam(':lname', $lname);
	$stmt->bindParam(':email', $email);

	$stmt->execute();
	
	
	if ($stmt->fetch(PDO::FETCH_ASSOC) == 0) {
		return false;
	}
	else {
		return true;
	}

}

function updatePassword($email, $password) {
	GLOBAL $pdo;

	$salt = getSalt("", 12);
	$hash = encrypt($salt, $password);

	$sql = "update users set salt = :salt, hash = :hash where email = :email";
	$stmt = $pdo->prepare($sql);

	$stmt->bindParam(':email', $email);
	$stmt->bindParam(':salt', $salt);
	$stmt->bindParam(':hash', $hash);

	$stmt->execute();

	echo "Password updated successfully.";
}

// Post authentication

function getUser($email) {
	GLOBAL $pdo;

	$sql = "select userid, fname, lname, email, role from users where email = :email";
	$stmt = $pdo->prepare($sql);

	$stmt->bindParam(':email', $email);
	$stmt->execute();

	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	return $result;
}

function editUser($userid, $fname, $lname, $email, $password) {
	GLOBAL $pdo;

	$salt = getSalt("", 12);
	$hash = encrypt($salt, $password);
	
	$sql = "update users set fname = :fname, lname = :lname, email = :email,
		salt = :salt, hash = :hash where userid = :userid";
	$stmt = $pdo->prepare($sql);

	$stmt->bindParam(':userid', $userid);
	$stmt->bindParam(':fname', $fname);
	$stmt->bindParam(':lname', $lname);
	$stmt->bindParam(':email', $email);
	$stmt->bindParam(':salt', $salt);
	$stmt->bindParam(':hash', $hash);

	$stmt->execute();
}

function removeUser($userid) {
	GLOBAL $pdo;

	$sql = "delete from users where userid = :userid";
	$stmt = $pdo->prepare($sql);

	$stmt->bindParam(':userid', $userid);

	$stmt->execute();
}

?>

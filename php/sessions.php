<?php

require("userManage.php");

try {

	require_once("dbConnect.php");

	if (isset($_POST['submit'])) {

		$email = htmlentities($_POST['email']);

		if (!userExists($email)) {
			echo "No such user";
		}

		else {

			$password = htmlentities($_POST['password']);

			$salt = getPassword($email)['salt'];
			$hash = getPassword($email)['hash'];

			if (encrypt($salt, $password) != $hash) {
				echo "Access Denied.";
			}

			else {
				session_start();
			}

		}

	}

}

catch(PDOException $e) {echo $e->getMessage();}

?>

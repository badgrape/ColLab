<?php
session_start();
require("userManage.php");
include("debug.php");

// Prepare a response to be sent when the page is requested

// Retrieve the Request Data
$requestJson = file_get_contents('php://input');

// Convert request JSON data back into a PHP array
$requestPhp = json_decode($requestJson, true);

// Convert data into a postLike-like array with more meaningful indices
for ($i = 0; $i < count($requestPhp); $i++) {
	$postLike[$requestPhp[$i]['name']] = $requestPhp[$i]['value'];
}

if (isset($postLike['operation'])) {
	
	if ($postLike['operation'] == "login") {
		
	// Log in
	
		try {
	
		require_once("dbConnect.php");
	
		$email = htmlentities($postLike['email']);
	
			if (!userExists($email)) {
				echo "No such user";
				session_destroy();
			}
	
			else {
	
				$password = htmlentities($postLike['password']);
	
				$salt = getPassword($email)['salt'];
				$hash = getPassword($email)['hash'];
	
				if (encrypt($salt, $password) != $hash) {
					echo "Access Denied.";
					session_destroy();
				}
	
				else {
					$_SESSION['user'] = getUser($email);
					$user = json_encode($_SESSION['user']);
					echo $user;
				}
	
			}
	
		}
	
		catch(PDOException $e) {echo $e->getMessage();}

	}

	elseif ($postLike['operation'] == "register") {
	
		try {
		
			require_once("dbConnect.php");
		
			$pass01 = htmlentities($postLike['password']);
			$pass02 = htmlentities($postLike['passwordconf']);
		
			if (!matches($pass01, $pass02)) {
				echo "Passwords must match. Try again.";
				session_destroy();
			}

			else {

			$email01 = htmlentities($postLike['email']);
			$email02 = htmlentities($postLike['emailconf']);

				if (!matches($email01, $email02)) {
					echo "Email addresses must match. Try again.";
					session_destroy();
				}
				
				else {
					
					if (userExists($email01)) {
						echo "User already exists.";
						session_destroy();
					}
		
					else {
						
						$fname = htmlentities($postLike['fname']);
						$lname = htmlentities($postLike['lname']);
						$role = htmlentities($postLike['role']);
		
						addUser($fname, $lname, $role, $email01, $pass01);

						$_SESSION['user'] = getUser($email01);
						$user = json_encode($_SESSION['user']);
						echo $user;
					
					}
		
				}

			}	
				
		}

catch(PDOException $e) {echo $e->getMessage();}
	
	}

	elseif ($postLike['operation'] == "recover") {

		try {
		
			require_once("dbConnect.php");
		
			$pass01 = htmlentities($postLike['password']);
			$pass02 = htmlentities($postLike['passwordconf']);
		
			if (!matches($pass01, $pass02)) {
				echo "<p>Passwords must match. Try again.</p>";
				session_destroy();
			}
		
			else {
			
				$fname = htmlentities($postLike['fname']);
				$lname = htmlentities($postLike['lname']);
				$email = htmlentities($postLike['email']);
		
				if (!requestedBy($fname, $lname, $email)) {
					echo "<p>The information your provided does not match our records.</p>";
					session_destroy();
				}
		
				else {
					updatePassword($email, $pass01);

					//session_start();
					$_SESSION['user'] = getUser($email);
					$user = json_encode($_SESSION['user']);
					echo $user;
				}
		
			}
		
		}
		
		catch(PDOException $e) {echo $e->getMessage();}

	}

	elseif ($postLike['operation'] == "editUser") {

		try {
		
			require_once("dbConnect.php");
		
			$pass01 = htmlentities($postLike['password']);
			$pass02 = htmlentities($postLike['passwordconf']);
		
			if (!matches($pass01, $pass02)) {
				echo "Passwords must match. Try again.";
			}

			else {

				$email = htmlentities($postLike['email']);

				if (userExists($email) && $email != $_SESSION['user']['email']) {
					echo "Email address belongs to another user.";
				}
		
				else {
						
					$fname = htmlentities($postLike['fname']);
					$lname = htmlentities($postLike['lname']);
		
					editUser($_SESSION['user']['userid'], $fname, $lname, $email, $pass01);

					$_SESSION['user'] = getUser($email);
					$user = json_encode($_SESSION['user']);
					echo $user;
					
				}
		
			}

		}	
				
		catch(PDOException $e) {echo $e->getMessage();}

	}

	elseif ($postLike['operation'] == "getUser") {

		$user = json_encode($_SESSION['user']);
		echo $user;
	
	}

	elseif ($postLike['operation'] == "logout") {
		
		session_unset();
		session_destroy();

		$redirect = "index.htm";
		echo $redirect;
	
	}

	elseif ($postLike['operation'] == "getUser") {

		$user = json_encode($_SESSION['user']);
		echo $user;
	
	}
}

else {echo "No data.";}

?>

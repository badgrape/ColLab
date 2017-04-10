<!DOCTYPE html>
<html>
<body>

<?php

require("dbFunctions.php");

try {

	require_once("dbConnect.php");

	if (isset($_POST['submit'])) {

		$pass01 = htmlentities($_POST['pass_set']);
		$pass02 = htmlentities($_POST['pass_conf']);

		if (!matches($pass01, $pass02)) {
			echo "Passwords must match. Try again.";
		}

		else {
		
			$user = htmlentities($_POST['user']);

			if (userExists($user)) {
				echo "User already exists. Try again.";
			}

			else {
				
				$fname = htmlentities($_POST['fname']);
				$lname = htmlentities($_POST['lname']);
				$email = htmlentities($_POST['email']);

				addUser($user, $fname, $lname, $email, encrypt($pass01));
			
			}

		}
		
	}

}

catch(PDOException $e) {echo $e->getMessage();}

?>

<h2>New User</h2>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<p><input type="text" name="user" placeholder="Username" required="required" /></p>
	<p><input type="text" name="fname" placeholder="First Name" required="required" /></p>
	<p><input type="text" name="lname" placeholder="Last Name" required="required" /></p>
	<p><input type="email" name="email" placeholder="Your email" required="required" /></p>
	<p>
		<input type="password" name="pass_set" placeholder="Type a password" required="required" />
		<input type="password" name="pass_conf" placeholder="Type again password" required="required" />
	</p>
	<p><input type="submit" name="submit" value="Register" /></p>
</form>

<p><a href="login.php">Cancel Registration</a></p>

</body>
</html>


<!DOCTYPE html>
<html>
<body>

<?php

require("dbFunctions.php");

try {

	require_once("dbConnect.php");

	if (isset($_POST['submit'])) {

		$pass01 = htmlentities($_POST['pass_reset']);
		$pass02 = htmlentities($_POST['pass_conf']);

		if (!matches($pass01, $pass02)) {
			echo "<p>Passwords must match. Try again.</p>";
		}

		else {
		
			$user = htmlentities($_POST['user']);
			$fname = htmlentities($_POST['fname']);
			$lname = htmlentities($_POST['lname']);

			if (!requestedBy($user, $fname, $lname)) {
				echo "<p>The information your provided does not match our records.
					Please call technical support.</p>";
			}

			else {
				updatePassword($user, encrypt($pass01));
			}

		}

	}

}

catch(PDOException $e) {echo $e->getMessage();}

?>

<h2>Change Password</h2>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<p><input type="text" name="user" placeholder="Username" required="required" /></p>
	<p><input type="text" name="fname" placeholder="First Name" required="required" /></p>
	<p><input type="text" name="lname" placeholder="Last Name" required="required" /></p>
	<p>
		<input type="password" name="pass_reset" placeholder="Type a new password" required="required" />
		<input type="password" name="pass_conf" placeholder="Type again password" required="required" />
	</p>
	<p><input type="submit" name="submit" value="Change Password" /></p>
	</form>
	
	<p><a href="login.php">Cancel</a></p>

</body>
</html>

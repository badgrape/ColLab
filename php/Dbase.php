<?php

class Dbase {

  var $pdo;

  public function __construct($db, $user, $pass) {
  	$this->pdo = new PDO ("mysql:host=localhost;dbname=$db", $user, $pass);
  	$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

	public function getUsers() {
		$sql = "select name, email from users";
		$stmt = $this->pdo->query($sql);
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

}

?>

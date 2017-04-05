<?php

class User {

	// Instance variables;

	var $userId;
	var $userName;
	var $userEmail;

	// Constructor
	
	function __construct($id, $name, $email) {

		$this->userId = $id;
		$this->userName = $name;
		$this->userEmail = $email;
	
	}

	// Accessors

	function getId() {
		return $this->userId;
	}

	function getName() {
		return $this->userName;
	}

	function getEmail() {
		return $this->userEmail;
	}

	// Mutators

	function setId($id) {
		$this->userId = $id;
	}

	function setName($name) {
		$this->userName = $name;
	}

	function setEmail($email){
		$this->userEmail = $email;
	}

}

?>

<?php

class user {
	private $username;
	private $encryptedPassword;
	private $isVegetarian;
	private $isVegan;
	public $isSignedIn;

	public function __construct() {

	}

	public function setEncryptedPassword($password) {
		$this->encryptedPassword = encrypt($password);
	}

	public function store() {

	}
}

?>
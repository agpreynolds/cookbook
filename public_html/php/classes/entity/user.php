<?php

class user {
	public $username;
	public $isSignedIn;
	public $isVegetarian;
	public $isVegan;

	public function __construct() {

	}

	public function populate($userData) {
		$this->username = $userData['username'];
	}

	public function exists($username) {
		global $db;

		$result = $db->select(array(
			'select' => 'username,password',
			'table' => 'user',
			'where' => "username = '$username'"
		));

		return ( $result->num_rows === 1 ? $result : 0);
	}
}

?>
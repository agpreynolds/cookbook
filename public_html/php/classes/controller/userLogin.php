<?php

class userLogin extends validateForm {
	public function __construct($formData) {
		if (!$formData || $user->isSignedIn) { return false; }

		parent::__construct($formData);
		
		if ( $this->isValid() ) {
			$this->authenticate(
				$this->formData['username'],
				encrypt($this->formData['password'])
			);
		}

		$this->constructResponse();
	}
	private function authenticate($username,$password) {
		$db = new db();

		$result = $db->select(array(
			'select' => 'username,password',
			'table' => 'user',
			'where' => "username = '$username' AND password = '$password'"
		));

		//Check we only have one user
		//0 records - Incorrect username / password combo trapped here
		//More than 1 record - Check db constraints
		if ( $result->num_rows === 1 ) {
			$user->username = $username;
			$user->isSignedIn = 1;
			return 1;
		}
		$this->errors[] = 'authentication_failed';
	}
}

?>

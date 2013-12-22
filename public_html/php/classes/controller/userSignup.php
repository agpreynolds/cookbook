<?php

class userSignup extends validateForm {
	public function __construct($formData) {
		if (!$formData) { return false; }
				
		$this->formID = 'userSignup';

		parent::__construct($formData);


		if ( $this->isValid() ) {
			$this->register(
				$this->formData['username'],
				encrypt($this->formData['password'])
			);
		}

		$this->constructResponse();
	}

	protected function isValid() {
		if ($_SESSION['user']->exists($this->formData['username'])) {
			$this->errors[] = 'user_exists_userSignup';
		}
		if ($_SESSION['user']->isSignedIn) {
			$this->errors[] = 'user_isSignedIn_userSignup';
		}

		parent::isValid();

		return $this->errors ? 0 : 1;

	}

	private function register($username,$password) {
		global $db;
		$db->insert(
			array(
				'table' => 'user',
				'values' => "'$username','$password'"
			)
		);

		$_SESSION['user']->isSignedIn = 1;
		$_SESSION['user']->populate(array(
			'username' => $username
		));			
		
		

	}
}

?>
<?php

class userLogin extends validateForm {
	public $formID;

	public function __construct($formData) {
		if (!$formData) { 
			return false; 
		}

		$this->formID = 'userLogin';
		
		parent::__construct($formData);
		
		if ($_SESSION['user']->isSignedIn) {
			$this->errors[] = $this->setError('user_isSignedIn');
		}
		
		if ( $this->isValid() && !$this->errors ) {
			$this->authenticate(
				$this->formData['username'],
				encrypt($this->formData['password'])
			);
		}

		$this->constructResponse();
	}
	private function authenticate($username,$password) {
		//Check we only have one user
		//0 records - user not found
		//More than 1 record - Check db constraints
		if ( $result = $_SESSION['user']->exists($username) ) {
			$userData = $result->fetch_assoc();

			if ($userData['password'] === $password) {
				$_SESSION['user']->isSignedIn = 1;
				$_SESSION['user']->populate($userData);				
			}
			else {
				$this->errors[] = $this->setError('password_incorrect');
			}
		}
		else {
			$this->errors[] = $this->setError('user_not_recognized');
		}
	}
}

?>

<?php

class userLogin extends validateForm {
	/*
		* @Override - validateForm::isValid()
	*/
	protected function isValid() {
		if ($_SESSION['user']->isSignedIn) {
			$this->setError('user_isSignedIn');
		}

		parent::isValid();

		return $this->hasErrors ? 0 : 1;
	}
	/*
		* Function should exist in all subclasses of validateForm
	*/
	protected function run() {
		$this->authenticate(
			$this->formData['username'],
			encrypt($this->formData['password'])
		);
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
				$_SESSION['user']->lookup();
			}
			else {
				$this->setError('password_incorrect','password');
			}
		}
		else {
			$this->setError('user_not_recognized','username');
		}
	}
}

?>

<?php

class userLogout extends validateForm {
	
	public function __construct($formData) {
		if (!$formData) { 
			return false; 
		}

		$this->formID = 'userLogout';
		
		parent::__construct($formData);
		
		if (!$_SESSION['user']->isSignedIn) {
			$this->errors[] = $this->setError('user_notSignedIn','');
		}
		
		if ( $this->isValid() && !$this->errors ) {
			$this->logout();
		}

		$this->constructResponse();
	}
	private function logout() {
		global $session;
		$session->stop();		
	}
}

?>
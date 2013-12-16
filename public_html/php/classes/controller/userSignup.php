<?php

class userSignup extends validateForm {
	public function __construct($formData) {
		if (!$formData || $user->isSignedIn) { return false; }
				
		parent::__construct($formData);
		if ( $this->isValid() ) {
			$this->register(
				$this->formData['username'],
				encrypt($this->formData['password'])
			);
		}
	}

	private function register($username,$password) {
		$db = new db();
		$db->insert(
			array(
				'table' => 'user',
				'values' => "'$username','$password'"
			)
		);
	}
}

?>
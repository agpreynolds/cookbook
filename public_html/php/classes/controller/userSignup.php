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
			$this->errors[] = $this->setError('user_exists');
		}
		if ($_SESSION['user']->isSignedIn) {
			$this->errors[] = $this->setError('user_isSignedIn');
		}

		parent::isValid();

		return $this->errors ? 0 : 1;

	}

	private function register($username,$password) {
		global $db, $arcDb;
		
		$db->insert(
			array(
				'table' => 'user',
				'values' => "'$username','$password'"
			)
		);

		$triples = array(
			"dUser:{$username} a foaf:Person ;" ,
			"rdfs:label '$username'"
		);
		$arcDb->insert( $triples );

		$_SESSION['user']->isSignedIn = 1;
		$_SESSION['user']->populate(array(
			'username' => $username
		));
	}
}

?>
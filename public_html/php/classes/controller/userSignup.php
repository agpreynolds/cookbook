<?php

class userSignup extends validateForm {
	/*
		* @Override - validateForm::isValid()
	*/
	protected function isValid() {
		if ($_SESSION['user']->exists($this->formData['username'])) {
			$this->setError('user_exists');
		}
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
		$this->register(
			$this->formData['username'],
			encrypt($this->formData['password'])
		);
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
		$_SESSION['user']->lookup();
	}
}

?>
<?php

class userPreferences extends validateForm {
	/*
		* Function should exist in all subclasses of validateForm
	*/
	protected function run() {
		$this->update();
	}
	/*
		* Updates user preferences in user model
		* Writes triples to DB
	*/
	private function update() {
		$_SESSION['user']->populate($this->formData);

		if ( !$_SESSION['user']->store() ) {
			$this->setError('db_failed','');
		}
	}
}

?>
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
		//Yuck - checkboxes not passed if value is null...
		if (!$this->formData['isVegetarian']) {
			$this->formData['isVegetarian'] = 0;
		}
		if (!$this->formData['isVegan']) {
			$this->formData['isVegan'] = 0;
		}

		$_SESSION['user']->populate($this->formData);

		if ( !$_SESSION['user']->store() ) {
			$this->setError('db_failed','');
		}
	}
}

?>
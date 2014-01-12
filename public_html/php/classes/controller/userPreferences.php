<?php

class userPreferences extends validateForm {
	public function __construct($formData) {
		$this->formID = 'userPreferences';

		parent::__construct($formData);

		if ( $this->isValid() && !$this->errors ) {
			// $_SESSION['user']->isVegetarian = ( isset($formData['isVegetarian']) ) ? 1 : 0;
			// $_SESSION['user']->isVegan = ( isset($formData['isVegetarian']) ) ? 1 : 0;
			// $_SESSION['user']->isLactoseIntolerant = ( isset($formData['isLactoseIntolerant']) ) ? 1 : 0;
			$_SESSION['user']->populate($formData);

			if ( !$_SESSION['user']->store() ) {
				$this->errors[] = $this->setError('db_failed','');
			}			
		}

		$this->constructResponse();
	}
}

?>
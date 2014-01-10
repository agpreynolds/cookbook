<?php

class recipeModerate extends validateForm {
	public $formID;

	public function __construct($formData) {
		if (!$formData) { 
			return false; 
		}

		$this->formID = 'recipeModerate';

		parent::__construct($formData);
		
		if ( $this->isValid() && !$this->errors ) {
			//TODO: Process Report
		}

		$this->constructResponse();
	}
}

?>
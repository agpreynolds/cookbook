<?php

class validateForm {
	protected $formData;
	protected $errors;
	
	/*
		* Construct - Should be called from all formhandler classes
	*/
	protected function __construct($formData) {
		$this->formData = $formData;
		$this->errors = array();
	}

	/*
		* Applies requested validation functions to all form fields
		* Returns 1 if all success
		* On error, push to errors array and continue validation - return 0 at eof
	*/
	protected function isValid() {
		//HACK REMOVE
		return 1;
		var_dump($this->formData);
		foreach ($this->formData as $key => $value) {
			echo $key;
		}
	}

	/*
		* Constructs a JSON array to return to the frontend
	*/
	protected function constructResponse() {
		$response = array();
		if ($this->errors) {
			$response['type'] 		= 'error';
			$response['messages'] 	= $this->errors;
		}
		else {
			$response['type'] 		= 'success';
		}
		echo json_encode($response);
	}

	/*
		* Validates form fields with the required validator
		* Returns 0 if validation failed
	*/
	protected function required($val) {
		// return ? 1 : 0;
	}

	/*
		* Validates form fields with a minimum length set
		* Returns 0 if validation failed
	*/
	protected function minLength($val) {
		// return ? 1 : 0;
	}

	/*
		* Validates form fields with a maximum length set
		* Returns 0 if validation failed
	*/
	protected function maxLength($val) {
		// return ? 1 : 0;
	}
}

?>
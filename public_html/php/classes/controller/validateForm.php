<?php

class validateForm {
	protected $formData;
	protected $errors;
	protected $config;
	
	/*
		* Construct - Should be called from all formhandler classes
	*/
	protected function __construct($formData) {
		$this->formData = $formData;
		$this->config = getForm($this->formID);
		$this->errors = array();
	}

	/*
		* Applies requested validation functions to all form fields
		* Returns 1 if all success
		* On error, push to errors array and continue validation - return 0 at eof
	*/
	protected function isValid() {
		
		foreach ($this->config['fields'] as $key => $value) {
			$prefix = '';
			if ( $value['type'] == 'array' ) {
				$prefix = 'array_';
			}

			if ( isset($value['validators']) ) {
				foreach ( $value['validators'] as $validator => $param ) {
					//Hmm... Better way to handle array inputs
					$validator = $prefix . $validator;
					if ( !$this->$validator($this->formData[$key],$param) ) {
						$this->errors[] = $this->setError($validator . '_' . $key,$key);					
					}
				}				
			}
			
		}
		if (isset($this->config['validators'])) {
			foreach ($this->config['validators'] as $key => $value) {
				if ( !$this->$key($value) ) {
					$this->errors[] = $this->setError($key . '_' . $value[0]);
				}
			}			
		}
		return ($this->errors) ? 0 : 1;
	}

	/*
		* Constructs an error message based on a given key
		* Returns error object
	*/
	protected function setError($key,$field) {
		if ($this->config['errors'] && $this->config['errors'][$key]) {
			$message = $this->config['errors'][$key];
		}
		else {
			$message = $key;
		}

		return array(
			'key' => $key,
			'text' => $message,
			'field' => $field
		);
	}

	/*
		* Constructs a JSON object to return to the frontend
	*/
	protected function constructResponse() {
		$response = array();
		if ($this->errors) {
			$response['type'] 		= 'error';
			$response['messages'] 	= $this->errors;
			if ( isset($this->config['onError']) ) {
				$response['onError'] = $this->config['onError'];
			}
		}
		else {
			$response['type'] 		= 'success';
			if ( isset($this->config['onSuccess']) ) {
				$response['onSuccess'] = $this->config['onSuccess'];	
			}
		}
		echo json_encode($response);
	}

	/*
		* Validates form fields with the required validator
		* Matches values containing only whitespace
		* Returns 0 if validation failed
	*/
	protected function required($val,$param) {
		return ( preg_match('/^\s*$/',$val) || $val == '0' ) ? 0 : 1;
	}

	/*
		* Validates form fields with a minimum length set
		* Returns 0 if validation failed
	*/
	protected function minLength($val,$param) {
		return ( strlen($val) >= $param ) ? 1 : 0;
	}

	/*
		* Validates an array type field with minimum length
		* Returns 0 if validation failed
	*/
	protected function array_minLength($val,$param) {
		return ( count(array_filter($val)) >= $param ) ? 1 : 0;
	}

	/*
		* Validates form fields with a maximum length set
		* Returns 0 if validation failed
	*/
	protected function maxLength($val,$param) {
		return ( strlen($val) <= $param ) ? 1 : 0;
	}

	/*
		* Validates multiple form fields to have an identical value
		* Returns 0 if any fields do not match
	*/
	protected function fieldsIdentical($values) {
		foreach ($values as $fieldVal) {
			if (isset($testVal)) {
				if ($this->formData[$fieldVal] != $testVal) {
					return 0;
				}
			}
			else {
				$testVal = $this->formData[$fieldVal];
			}
		}
		return 1;
	}
}

?>
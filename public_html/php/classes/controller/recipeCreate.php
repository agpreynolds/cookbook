<?php

class recipeCreate extends validateForm {
	public $formID;

	public function __construct($formData) {
		if (!$formData) { 
			return false; 
		}

		$this->formID = 'recipeCreate';

		parent::__construct($formData);

		if (!$_SESSION['user']->isSignedIn) {
			$this->errors[] = $this->setError('user_notSignedIn','');
		}
		else {
			$this->formData['author'] = $_SESSION['user']->username;
		}
		
		if ( $this->isValid() && !$this->errors ) {
			$recipe = new recipe($this->formData);
			
			if ($file = $_FILES['image']) {
				$fileUpload = new fileUpload(array(
					'filehandle' => $file,
					'filename' => 'recipe_' . preg_replace('/\s+/', '', $recipe->label)
				));
			}
			else {
				$this->errors[] = $this->setError('file_not_found','');
			}


			if ( !$recipe->store() ) {
				$this->errors[] = $this->setError('db_failure','');
			}
		}

		$this->constructResponse();
	}
}

?>

<?php

class recipeCreate extends validateForm {
	/*
		* @Override - validateForm::isValid()
	*/
	protected function isValid() {
		if (!$_SESSION['user']->isSignedIn) {
			$this->setError('user_notSignedIn');
		}

		parent::isValid();

		return $this->hasErrors ? 0 : 1;
	}
	/*
		* Function should exist in all subclasses of validateForm
	*/
	protected function run() {
		$this->create();
	}
	private function create() {
		$this->formData['author'] = $_SESSION['user']->username;

		$recipe = new recipe($this->formData);
			
		if ($file = $_FILES['image']) {
			$fileUpload = new fileUpload(array(
				'filehandle' => $file,
				'filename' => 'recipe_' . preg_replace('/\s+/', '', $recipe->label)
			));
		}
		else {
			$this->setError('file_not_found','');
		}

		if ( !$recipe->store() ) {
			$this->setError('db_failure','');
		}
	}
}

?>

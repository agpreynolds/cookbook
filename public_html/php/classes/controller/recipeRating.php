<?php

class recipeRating extends validateForm {
	/*
		* Function should exist in all subclasses of validateForm
	*/
	protected function run() {
		$this->store();
	}
	private function store() {
		$rating = new rating($this->formData);
		$rating->store();
	}
}

?>
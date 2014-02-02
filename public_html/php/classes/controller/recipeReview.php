<?php

class recipeReview extends validateForm {
	/*
		* Function should exist in all subclasses of validateForm
	*/
	protected function run() {
		$this->store();
	}
	private function store() {
		$review = new review($this->formData);
		$review->store();
	}
}

?>
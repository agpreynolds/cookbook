<?php

class recipeSearch {
	private $results;

	public function __construct($data) {
		$this->results = array(
			'recipes' => array(
				array(
					'name' => 'pizza'
				),
				array(
					'name' => 'pasta'
				)
			) 
		);
	}

	public function getResults() {
		return $this->results;
	}
}

?>
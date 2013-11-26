<?php

class recipe {
	public $author;
	public $name;
	public $cuisine;
	public $ingredients;
	public $description;
	public $isComplete;
	public $dateUploaded;
	public $dateLastUpdated;

	public function __construct($data) {
		$this->name = $data['name'];
		
	}

	public function isVegetarianSuitable() {
		foreach ( $this->ingredients as $currentIngredient ) {
			$ingredient = new ingredient($currentIngredient);

			if ( $ingredient->getFoodGroup() == 'meat' ) {
				return 0;
			}
		}
		return 1;
	}

	public function isVeganSuitable() {

	}

	public function store() {

	}
}

?>
<?php

class recipe {
	private $author;
	private $name;
	private $cuisine;
	private $ingredients;
	private $description;
	private $isComplete;
	private $dateUploaded;
	private $dateLastUpdated;

	public function __construct() {
		
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
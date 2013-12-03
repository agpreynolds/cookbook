<?php

class recipe {
	public $author;
	public $name;
	public $cuisine;
	public $ingredients;
	public $tools;
	public $techniques;
	public $steps;
	public $description;
	public $isComplete;
	public $dateUploaded;
	public $dateLastUpdated;

	public function __construct($data) {
		$this->name = $data['name'];
		
		//TODO: Replace Dummydata
		$this->author = 'Alex';
		$this->description = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit essecillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";
		$this->ingredients = array('flour','egg','milk');
		$this->tools = array('knife','fork','spoon');
		$this->techniques = array('cook','stir');
		$this->steps = array('put it in the oven','wait till its done');
		
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
<?php

class searchResults {
	private $recipes;
	
	public function __construct($recipes) {
		$this->recipes = $recipes;
		
		$this->applyFilters();

		$this->outputHTML();
	}

	private function applyFilters() {
		if ($_SESSION['user']->isVegetarian) {
			$this->recipes = $this->removeVegetarianUnsuitableRecipes();			
		}
	}

	private function removeVegetarianUnsuitableRecipes() {
		$recipes = [];
		foreach ($this->recipes as $recipe) {
			if (!$recipe['hasMeat']) {
				$recipes[] = $recipe;
			}
		}
		return $recipes;
	}

	private function outputHTML() {		
		ob_start();
		foreach ($this->recipes as $recipe ) {
			$recipe = new recipe($recipe);
			$class = ( $recipe->username === $_SESSION['user']->username ) ? 'userCreated' : '';
			include( getAbsIncPath('/templates/searchPanels/resultSmall/resultItem.php') );
		}
	}
}

?>
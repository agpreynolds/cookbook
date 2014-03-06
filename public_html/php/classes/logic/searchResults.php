<?php

class searchResults {
	private $recipes;
	
	public function __construct($recipes) {
		$this->recipes = $recipes;
		
		$this->applyFilters();

		global $response;
		$response->data = $this->instantiateRecipes();
	}

	private function applyFilters() {
		if ($_SESSION['user']->isVegetarian) {
			$this->recipes = $this->removeVegetarianUnsuitableRecipes();			
		}
		if ($_SESSION['user']->isVegan) {
			$this->recipes = $this->removeVeganUnsuitableRecipes();
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

	private function removeVeganUnsuitableRecipes() {
		$recipes = [];
		foreach ($this->recipes as $recipe) {
			if (!isset($recipe['hasMeat']) && !isset($recipe['hasSeaFood']) && !isset($recipe['hasEgg']) && !isset($recipe['hasDairy']) ) {
				$recipes[] = $recipe;
			}
		}
		return $recipes;
	}
	private function instantiateRecipes() {
		$recipes = [];
		foreach ($this->recipes as $recipe) {
			$recipes[] = new recipe($recipe);
		}
		return $recipes;
	}
}

?>
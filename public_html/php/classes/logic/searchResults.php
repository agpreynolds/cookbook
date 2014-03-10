<?php

class searchResults {
	private $recipes;
	
	public function __construct($recipes) {
		$this->recipes = $recipes;
		
		$this->applyFilters();

		global $response;
		if ($this->recipes) {
			$response->data = $this->instantiateRecipes();			
		}
		//What if we just filterec all our recipes
		else {
			$response->setMessage([
				'key' => 'recipes_filtered',
				'text' => 'No results found'
			]);
		}
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
				$setMessage = 1;
			}
		}
		if ($setMessage) {
			global $response;
			$response->setMessage([
				'key' => 'vegetarian_filtered',
				'text' => 'Some recipes have been removed based on your dietary requirements'
			]);			
		}
		return $recipes;
	}

	private function removeVeganUnsuitableRecipes() {
		$recipes = [];
		foreach ($this->recipes as $recipe) {
			if (!isset($recipe['hasMeat']) && !isset($recipe['hasSeaFood']) && !isset($recipe['hasEgg']) && !isset($recipe['hasDairy']) ) {
				$recipes[] = $recipe;
				$setMessage = 1;
			}
		}
		if ($setMessage) {
			global $response;
			$response->setMessage([
				'key' => 'vegetarian_filtered',
				'text' => 'Some recipes have been removed based on your dietary requirements'
			]);			
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
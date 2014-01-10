<?php

class searchResults {
	private $recipes;
	private $results;

	public function __construct($recipeSearch) {
		$this->results = $recipeSearch->getResults();
		$this->recipes = $recipeSearch->getRecipes();
		ob_start();
	}

	public function outputHTML() {		
		foreach ($this->recipes as $recipe ) {
			$class = ( $recipe->username === $_SESSION['user']->username ) ? 'userCreated' : '';
			include( getAbsIncPath('/templates/searchPanels/resultSmall/resultItem.php') );
		}
	}
	public function returnJSON() {
		echo json_encode(
			array(
				'data' => $this->results,
				'html' => ob_get_clean()
			)
		);

	}
}

?>
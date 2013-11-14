<?php

class recipeSearch {
	private $recipes = array();

	public function __construct($data) {
		$db = new arcDb();
		$results = $db->query2(array(
				'prefix' => 'recipe: <http://linkedrecipes.org/schema/>',
				'cuisine' => strtolower($data['cuisineTypeOptions'][0])
			)
		);

		foreach ( $results as $result ) {
			$this->recipes[] = new recipe($result);
		}

		//$this->results = array(
		//	'recipes' => array(
		//		array(
		//			'name' => 'pizza'
		//		),
		//		array(
		//			'name' => 'pasta'
		//		)
		//	) 
		//);
	}

	public function getRecipes() {
		return $this->recipes;
	}
}

?>
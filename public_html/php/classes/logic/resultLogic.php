<?php

class resultLogic {
	public $recipe;

	public function __construct($data) {
		$this->recipe = $this->lookup($data);
	}

	public function outputIngredientList() {
		foreach ($this->recipe->ingredients as $ing) {
			include ( getAbsIncPath('/templates/searchPanels/resultLarge/ingredientItem.php') );
		}
	}
	public function outputToolList() {
		foreach ($this->recipe->tools as $tool) {
			include ( getAbsIncPath('/templates/searchPanels/resultLarge/toolItem.php') );
		}
	}
	public function outputTechniqueList() {
		foreach ($this->recipe->techniques as $tec) {
			include ( getAbsIncPath('/templates/searchPanels/resultLarge/techniqueItem.php') );
		}
	}
	public function outputStepList() {
		foreach ($this->recipe->steps as $step) {
			include ( getAbsIncPath('/templates/searchPanels/resultLarge/stepItem.php') );
		}
	}
	private function lookup($data) {
		global $arcDb;
		
		$ingredients = $quantity = array();

		$query = array(
			'select' => array(
				'?label',
				'?comment',
				'?username',
				'?cuisine',
				'?course'				
			),
			'where' => "
				<{$data['uri']}> a recipe:Recipe ; 
				rdfs:label ?label ;
				rdfs:comment ?comment ;
				recipe:cuisine ?cuisine ;
				recipe:course ?course ;
				rdf:author ?author .
				?author rdfs:label ?username
			",
			'single' => 1
		);
		
		$result = $arcDb->query2($query);

		$ingredientsQuery = array(
			'select' => array(
				'?ingredient',
				'?quantity'
			),
			'where' => "
				<{$data['uri']}> a recipe:Recipe ;
				recipe:ingredients ?ingredients .
				?ingredients ?p ?s .
				?s a recipe:Ingredient ;
				recipe:quantity ?quantity ;
				recipe:food ?food .
				?food rdfs:label ?ingredient
			"
		);

		$ingredientResults = $arcDb->query2($ingredientsQuery);
		
		foreach ( $ingredientResults as $ingredient ) {
			$ingredients[] = $ingredient['ingredient'];
			$quantity[] = $ingredient['quantity'];
		}

		$result['ingredients'] = $ingredients;
		$result['quantity'] = $quantity;

		return new recipe($result);
	}
}

?>
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

		$query = array(
			'select' => array(
				'?uri',
				'?label',
				'?comment',
				'?username',
				'?cuisine',
				'?course'
			),
			'where' => "
				?uri a recipe:Recipe ; 
				rdfs:label ?label ;
				rdfs:comment ?comment ;
				recipe:cuisine ?cuisine ;
				recipe:course ?course ;
				rdf:author ?author .
				?author rdfs:label ?username .
				FILTER (?uri = <{$data['uri']}>)
			"
		);
		
		$result = $arcDb->query2($query);
		return new recipe($result[0]);
	}
}

?>
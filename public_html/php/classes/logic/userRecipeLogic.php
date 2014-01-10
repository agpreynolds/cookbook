<?php

class userRecipeLogic {
	private $user;
	private $recipes;

	public function __construct() {
		$this->user = $_SESSION['user']->username;
		$this->lookupRecipes();
	}
	private function lookupRecipes() {
		global $arcDb;

		$queryData = array(
			'select' => array(
				'?uri',
				'?label',
				'?comment',
				'?author'
			),
			'where' => "
				?uri a recipe:Recipe ; 
				rdfs:label ?label ;
				rdfs:comment ?comment ;
				rdf:author ?author .
				?author rdfs:label '{$this->user}'
			"
		);
		
		$recipes = $arcDb->query2($queryData);

		foreach ( $recipes as $recipe ) {
			$this->recipes[] = new recipe($recipe);
		}
	}
	public function outputRecipes() {
		if (isset($this->recipes)) {
			foreach ( $this->recipes as $recipe ) {
				include ( getAbsIncPath('/templates/searchPanels/resultSmall/resultItem.php') );
			}			
		}
		else {
			echo 'No Recipes Found';
		}
	}

}

?>
<?php

class recipeSearch {
	private $recipes = array();
	private $results;
	private $config;
	private $queryData;

	public function __construct($data) {
		$this->config = getConfig('search');
		$this->generateQueryData($data);

		$db = new arcDb();
		$this->results = $db->query2($this->queryData);

		foreach ( $this->results as $result ) {
			$this->recipes[] = new recipe($result);
		}
	}

	private function generateQueryData($data) {
		$this->queryData = array(
			'prefixes' => 'recipe: <http://linkedrecipes.org/schema/>',
			'where' => "?recipe a recipe:Recipe ; rdfs:label ?name ; recipe:cuisine ?cuisine ; recipe:course ?course .",
			'filters' => array()
		);

		foreach ($data as $param => $value) {
			$facet = new facet($param,$this->config[$param]);
			if ($facet && $facet->mapsTo && $facet->active) {
				$this->queryData['filters'][$facet->mapsTo] = $value;
			}
		}		
	}

	public function getRecipes() {
		return $this->recipes;
	}
	public function getResults() {
		return $this->results;
	}
}

?>
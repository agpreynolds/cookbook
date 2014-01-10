<?php

class recipeSearch {
	private $recipes = array();
	private $results;
	private $config;
	private $queryData;

	public function __construct($data) {
		$this->generateQueryData($data);

		global $arcDb;
		$this->results = $arcDb->query2($this->queryData);

		foreach ( $this->results as $result ) {
			$this->recipes[] = new recipe($result);
		}
	}

	private function generateQueryData($data) {
		$this->queryData = array(
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
				?author rdfs:label ?username
			",
			'filters' => array()
		);

		foreach ($data as $param => $value) {
			$facet = new facet($param);
			if ($facet && $facet->shortcut) {
				$this->queryData['filters'][$facet->shortcut] = $value;
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
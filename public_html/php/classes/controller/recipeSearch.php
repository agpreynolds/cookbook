<?php

class recipeSearch extends validateForm {
	/*
		* Function should exist in all subclasses of validateForm
	*/
	protected function run() {
		if ( $results = $this->runQuery() ) {
			$html = new searchResults($results);
		}
		else {
			$this->setError('db_failure','');
		}
	}

	private function runQuery() {
		global $arcDb;

		$query = array(
			'select' => array(
				'?uri',
				'?label',
				'?username'
			),
			'where' => "
				?uri a recipe:Recipe ; 
				rdfs:label ?label ;
				rdfs:comment ?comment ;
				recipe:cuisine ?cuisine ;
				recipe:course ?course ;
				rdf:author ?author ;			
				recipe:ingredients ?ingredients .
				?ingredients ?p ?s .
				?s a recipe:Ingredient ;
				recipe:quantity ?quantity ;
				recipe:food ?ingredient .
				?author rdfs:label ?username
			",
			'filters' => array(),
			'distinct' => 1
		);

		$data = $this->formData;
		unset($data['formID']);

		foreach ($data as $param => $value) {
			$facet = new facet($param);
			if ($facet && $facet->shortcut) {
				$query['filters'][$facet->shortcut] = $value;
			}
		}

		return $results = $arcDb->query2($query);
	}
}

?>
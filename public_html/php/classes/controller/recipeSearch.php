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
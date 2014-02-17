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

		$where = "?uri a recipe:Recipe ; 
				rdfs:label ?label ;				
				rdf:author ?author ";
		$where .= $this->addCuisineTriples($this->formData['recipe:Cuisine']);
		$where .= $this->addCourseTriples($this->formData['recipe:Course']);
		$where .= $this->addIngredientsTriples($this->formData['recipe:Food']);
		$where .= ".\n ?author rdfs:label ?username";

		$query = array(
			'select' => array(
				'?uri',
				'?label',
				'?username'
			),
			'where' => $where,			
			'distinct' => 1
		);
		
		return $results = $arcDb->query2($query);
	}
	private function addIngredientsTriples($ingredients) {
		if (isset($ingredients)) {
			$qIngredients = ";\n recipe:ingredients ?ingredients .
				?ingredients";
			$qFood = '';
		
			for ( $i=1; $i<=count($ingredients); $i++ ) {
				$qIngredients .= " ?p{$i} ?s{$i}";
				$qIngredients .= ( $i != count($ingredients) ) ? ';' : '';
				$qFood .= ".\n ?s{$i} a recipe:Ingredient ;\n
					recipe:food <{$ingredients[$i-1]}>";
			}

			return $qIngredients . $qFood;
		}
	}
	private function addCuisineTriples($cuisine) {
		if (isset($cuisine)) {
			$OUT = '';
			foreach ($cuisine as $c) {
				$OUT .= ";\n recipe:cuisine <{$c}>";
			}
			return $OUT;			
		}
	}
	private function addCourseTriples($course) {
		if (isset($course)) {
			$OUT = '';
			foreach ($course as $c) {
				$OUT .= ";\n recipe:course <{$c}>";
			}
			return $OUT;			
		}
	}
}

?>
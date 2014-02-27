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
		
		$where .= $this->addCuisineTriples($this->formData['recipe:Cuisine']
			,$this->formData['recipe:Cuisine_type']);

		$where .= $this->addCourseTriples($this->formData['recipe:Course']
			,$this->formData['recipe:Course_type']);

		$where .= $this->addIngredientsTriples($this->formData['recipe:Food']
			,$this->formData['recipe:Food_type']);
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
	private function addIngredientsTriples($ingredients,$type) {
		if (isset($ingredients)) {
			$qIngredients = ".\n ?uri recipe:ingredients ?ingredients .
				?ingredients";
			$qFood = '';
		
			for ( $i=1; $i<=count($ingredients); $i++ ) {
				if ( $type == 'all' ) {
					$qIngredients .= " ?p{$i} ?s{$i}" . ( $i != count($ingredients) ? ';' : '' );
					$qFood .= ".\n ?s{$i} a recipe:Ingredient ;\n
						recipe:food <{$ingredients[$i-1]}>";					
				}
				elseif ( $type == 'one') {
					$qIngredients .= ( $i == 1 ? " ?p ?s" : '' );
					$qFood .= ( $i==1 ? ".\n ?s a recipe:Ingredient ;\n" : '') . "{ ?s recipe:food <{$ingredients[$i-1]}> }" . ( $i != count($cuisine)-1 ? 'UNION' : '' );
				}
			}

			return $qIngredients . $qFood;
		}
	}
	private function addCuisineTriples($cuisine,$type) {
		if (isset($cuisine)) {
			$OUT = '';
			for ($i=0; $i<count($cuisine); $i++) {
				if ( $type == 'all' ) {
					$OUT .= ";\n recipe:cuisine <{$cuisine[$i]}>";
				}
				elseif ( $type == 'one' ) {
					$OUT .= ( $i==0 ? ".\n" : '') . "{ ?uri recipe:cuisine <{$cuisine[$i]}> }" . ( $i < count($cuisine)-1 ? 'UNION' : '' );
				}
			}				
			return $OUT;			
		}
	}
	private function addCourseTriples($course,$type) {
		if (isset($course)) {
			$OUT = '';
			for ($i=0; $i<count($course); $i++) {
				if ( $type == 'all' ) {
					$OUT .= ";\n recipe:course <{$course[$i]}>";
				}
				elseif ( $type == 'one' ) {
					$OUT .= ( $i==0 ? ".\n" : '') . "{ ?uri recipe:course <{$course[$i]}> }" . ( $i < count($course)-1 ? 'UNION' : '' );
				}
			}				
			return $OUT;			
		}
	}
}

?>
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

		$query = array(
			'select' => array(
				'?uri',
				'?label',
				'?author',
				'?hasMeat',
				'?hasSeaFood',
				'?hasDairy',
				'?hasEgg'
			),
			'where' => $where,			
			'distinct' => 1,
			'group' => '?uri'
		);
		
		return $results = $arcDb->query2($query);
	}
	private function addIngredientsTriples($ingredients,$type) {
		$default = "
			.\n ?uri recipe:ingredients ?ingredients .
			?ingredients ?p ?s .
			?s a recipe:Ingredient ;
			recipe:food ?food .
			OPTIONAL { ?food ?hasMeat dFoodGroup:Meat }
			OPTIONAL { ?food ?hasDairy dFoodGroup:Dairy }
			OPTIONAL { ?food ?hasEgg dFoodGroup:Egg }
			OPTIONAL { ?food ?hasSeaFood dFoodGroup:SeaFood }
		";

		
		//If we have ingredients set in the search
		if (isset($ingredients)) {
			$qIngredients = ".\n ?ingredients";
			$qFood = '';
			//Check the search type
			if ( $type == 'all' ) {
				for ( $i=1; $i<=count($ingredients); $i++ ) {
					$qIngredients .= " ?p{$i} ?s{$i}" . ( $i != count($ingredients) ? ';' : '' );
					$qFood .= ".\n ?s{$i} a recipe:Ingredient ;\n
						recipe:food <{$ingredients[$i-1]}> ;";					
				}
			}
			elseif ( $type = 'one' ) {
				for ( $i=1; $i<=count($ingredients); $i++ ) {
					$qIngredients .= ( $i == 1 ? " ?p ?s" : '' );
					$qFood .= ( $i==1 ? ".\n ?s a recipe:Ingredient ;\n" : '') . "{ ?s recipe:food <{$ingredients[$i-1]}> }" . ( $i != count($cuisine)-1 ? 'UNION' : '' );
				}
			}
			return $default . $qIngredients . $qFood;
		}
		else {
			return $default;
		}
		
	}
	private function addCuisineTriples($cuisine,$type) {
		if (isset($cuisine)) {
			$OUT = '';
			for ($i=0; $i<count($cuisine); $i++) {
				if ( $type == 'all' ) {
					$OUT .= ".\n ?uri recipe:cuisine <{$cuisine[$i]}>";
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
					$OUT .= ".\n ?uri recipe:course <{$course[$i]}>";
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
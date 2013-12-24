<?php

class recipe {
	public $label;
	public $comment;
	public $course;
	public $cuisine;
	public $author;
	public $ingredients;
	public $tools;
	public $techniques;
	public $steps;
	public $isComplete;
	public $dateUploaded;
	public $dateLastUpdated;

	public function __construct($data) {
		foreach($data as $key => $value){
        	$this->{$key} = $value;
      	}
				
		//TODO: Replace Dummydata
		$this->ingredients = array('flour','egg','milk');
		$this->tools = array('knife','fork','spoon');
		$this->techniques = array('cook','stir');
		$this->steps = array('put it in the oven','wait till its done');
		
	}

	public function isVegetarianSuitable() {
		foreach ( $this->ingredients as $currentIngredient ) {
			$ingredient = new ingredient($currentIngredient);

			if ( $ingredient->getFoodGroup() == 'meat' ) {
				return 0;
			}
		}
		return 1;
	}

	public function isVeganSuitable() {

	}

	/*
		* Writes a recipe out to the database represented in triple stores
		* Returns 0 on Error
	*/
	public function store() {
		global $arcDb;

		$triples = "dRecipe:{$this->label} a recipe:Recipe ; 
			rdfs:label '{$this->label}' ;
			rdfs:comment '{$this->comment}' ;
			rdf:author dUser:{$this->author} ;
			recipe:course dCourse:{$this->course} ;
			recipe:cuisine dCuisine:{$this->cuisine}";
		
		$insertString = "INSERT INTO <...> { $q }";

		$result = $arcDb->insert( $triples );
		return  ( $result ) ? 1 : 0;
	}
}

?>
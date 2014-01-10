<?php

class recipe {
	public $uri;
	public $label;
	public $imagePath;
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

      	$this->config = getConfig('recipe');

      	//TODO: Replace Dummydata
		$this->ingredients = array('flour','egg','milk');
		$this->tools = array('knife','fork','spoon');
		$this->techniques = array('cook','stir');
		$this->steps = array('put it in the oven','wait till its done');

		//If the uri is not set we can generate it from the label
		if (!isset($this->uri) && isset($this->label)) {
			$this->uri = preg_replace('/\s+/', '', $this->label);
		}

		$baseImagePath = $this->config['base_image_path'] . preg_replace('/\s+/', '', $this->label);
		if ( $ext = getImageExtension($baseImagePath) ) {
			$this->imagePath = $baseImagePath . '.' . $ext;
		}
		else {
			$this->imagePath = $this->config['base_image_path'] . 'default.png';
		}	
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

		$triples = "dRecipe:{$this->uri} a recipe:Recipe ; 
			rdfs:label '{$this->label}' ;
			rdfs:comment '{$this->comment}' ;
			rdf:author dUser:{$this->author} ;
			recipe:course dCourse:{$this->course} ;
			recipe:cuisine dCuisine:{$this->cuisine}";

		$result = $arcDb->insert( $triples );
		return  ( $result ) ? 1 : 0;
	}
}

?>
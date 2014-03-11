<?php

class recipe {
	public $id;
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
	public $reviews;
	public $isComplete;
	public $dateUploaded;
	public $dateLastUpdated;
	private $config;

	public function __construct($data) {
		// if ( !isset($data['ingredients']) ) {
		// 	return null;
		// }
		
		$this->ingredients = $this->reviews = $this->steps = array();

		foreach($data as $key => $value){
    		$i = 0;
        	
        	//Creates an ingredient instance based on array position of name and quantity
        	if ( $key == 'ingredients' ) {
        		foreach ($value as $ingredient) {
        			$props = array(
        				'name' 		=> $ingredient,
        				'quantity' 	=> $data['quantity'][$i]
        			);
        			
        			$this->ingredients[] = new ingredient($props);

        			$i++;
        		}
        	}
        	elseif ( $key == 'reviews' ) {
        		foreach ($value as $review) {
        			$props = array(
        				'uri' => $review,
        				'author' => $data['reviewer'][$i],
        				'title' => $data['reviewTitle'][$i],
        				'text' => $data['reviewText'][$i]
        			);

        			$this->reviews[] = new review($props);

        			$i++;
        		}
        	}
        	else {
        		$this->{$key} = $value;
        	}
      	}

      	$this->config = getConfig('recipe');

      	//If the id is not set we can generate it from the uri
		if (!isset($this->id) && isset($this->uri)) {			
			preg_match('/\w*$/', $this->uri, $matches);
			$this->id = strtolower( array_shift($matches) );
		}

		$baseImagePath = $this->config['base_image_path'] . preg_replace('/\s+/', '', $this->label);
		if ( $ext = getImageExtension($baseImagePath) ) {
			$this->imagePath = $baseImagePath . '.' . $ext;
		}
		else {
			$this->imagePath = $this->config['base_image_path'] . 'default.png';
		}	
	}

	/*
		* Writes a recipe out to the database represented in triple stores
		* Returns 0 on Error
	*/
	public function store() {
		global $arcDb;


		$timestamp = time();
		$bNodeID = 'dIngredient:bn' . $timestamp;

		$ingredientTriples = array($bNodeID . ' a recipe:IngredientList ;');

		$i = 1;
		$count = count($this->ingredients);

		foreach ( $this->ingredients as $ingredient ) {
			if ( $ingredient->insertSuccessful ) {
				$triple = "rdf:_{$i} [ a recipe:Ingredient ;
				recipe:food dFood:{$ingredient->uri} ;
				recipe:quantity '{$ingredient->quantity}' ;
				]";
				
				$triple .= ( $i == $count ) ? '' : ';';
				
				$ingredientTriples[] = $triple;
				
				$i++;				
			}
		}

		$arcDb->insert( $ingredientTriples );		

		$triples = array(
			"dRecipe:{$this->id} a recipe:Recipe ;",
			"rdfs:label '{$this->label}' ;",
			"rdfs:comment '{$this->comment}' ;",
			"rdf:author dUser:{$this->author} ;",
			"recipe:course dCourse:{$this->course} ;",
			"recipe:cuisine dCuisine:{$this->cuisine} ;",
			"recipe:ingredients {$bNodeID}"
		);

		// var_dump($triples);
		return $result = $arcDb->insert( $triples );
	}
}

?>
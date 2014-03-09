<?php

class resultLogic {
	public $data;
	public $recipe;

	public function __construct($data) {
		$this->data = $data;
		
		global $response;
		$response->returnJSON = 1;
		$response->data = $this->lookup();
	}

	public function outputIngredientList() {
		foreach ($this->recipe->ingredients as $ing) {
			include ( getAbsIncPath('/templates/searchPanels/resultLarge/ingredientItem.php') );
		}
	}
	public function outputToolList() {
		foreach ($this->recipe->tools as $tool) {
			include ( getAbsIncPath('/templates/searchPanels/resultLarge/toolItem.php') );
		}
	}
	public function outputStepList() {
		foreach ($this->recipe->steps as $step) {
			include ( getAbsIncPath('/templates/searchPanels/resultLarge/stepItem.php') );
		}
	}
	public function outputReviews() {
		foreach ($this->recipe->reviews as $review) {
			include ( getAbsIncPath('/templates/searchPanels/resultLarge/reviewItem.php') );
		}
	}
	private function lookup() {
		global $arcDb;

		$ingredients = $quantity = array();
		
		$query = array(
			'select' => array(
				'?label',
				'?comment',
				'?username',
				'?cuisine',
				'?course'				
			),
			'where' => "
				<{$this->data['uri']}> a recipe:Recipe ; 
				rdfs:label ?label ;
				rdfs:comment ?comment ;
				recipe:cuisine ?cuisine ;
				recipe:course ?course ;
				rdf:author ?author .
				?author rdfs:label ?username
			",
			'single' => 1
		);
		
		$result = $arcDb->query2($query);

		$ingredientResults = $this->lookupIngredients();

		foreach ( $ingredientResults as $ingredient ) {
			$ingredients[] = $ingredient['ingredient'];
			$quantity[] = $ingredient['quantity'];
		}

		$result['ingredients'] = $ingredients;
		$result['quantity'] = $quantity;

		$reviewResults = $this->lookupReviews();

		$reviews = $reviewer = $title = $text = array();

		foreach ($reviewResults as $review) {
			$reviews[] = $review['review'];
			$reviewer[] = $review['reviewer'];
			$title[] = $review['title'];
			$text[] = $review['text'];
		}

		$result['reviews'] = $reviews;
		$result['reviewer'] = $reviewer;
		$result['reviewTitle'] = $title;
		$result['reviewText'] = $text;

		return new recipe($result);
	}
	private function lookupIngredients() {
		global $arcDb;

		$query = array(
			'select' => array(
				'?ingredient',
				'?quantity'
			),
			'where' => "
				<{$this->data['uri']}> a recipe:Recipe ;
				recipe:ingredients ?ingredients .
				?ingredients ?p ?s .
				?s a recipe:Ingredient ;
				recipe:quantity ?quantity ;
				recipe:food ?food .
				?food rdfs:label ?ingredient
			"
		);

		return $arcDb->query2($query);
	}
	private function lookupReviews() {
		global $arcDb;

		$query = array(
			'select' => array(
				'?review',
				'?reviewer',
				'?title',
				'?text'
			),
			'where' => "
				<{$this->data['uri']}> a recipe:Recipe ;
				rev:hasReview ?review .
				?review a rev:Review ;
				rev:reviewer ?reviewer ;
				rev:title ?title ;
				rev:text ?text
			"
		);

		return $arcDb->query2($query);
	}
}

?>
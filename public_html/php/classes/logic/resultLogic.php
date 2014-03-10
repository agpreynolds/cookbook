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
				dRecipe:{$this->data['id']} a recipe:Recipe ; 
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
				dRecipe:{$this->data['id']} a recipe:Recipe ;
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
				dRecipe:{$this->data['id']} a recipe:Recipe ;
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
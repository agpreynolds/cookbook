<?php

class user {
	public $username;
	public $isSignedIn;
	public $isVegetarian;
	public $isVegan;
	public $isLactoseIntolerant;

	public function __construct() {

	}

	public function populate($userData) {
		foreach ( $userData as $key => $value ) {
        	$this->{$key} = $value;
      	}      	
	}

	public function exists($username) {
		global $db;

		$result = $db->select(array(
			'select' => 'username,password',
			'table' => 'user',
			'where' => "username = '$username'"
		));

		return ( $result->num_rows === 1 ? $result : 0);
	}

	public function lookup() {
		global $arcDb;

      	$query = array(
      		'select' => array(
      			'?isVegetarian',
      			'?isVegan'
      		),
      		'where' => "
      			dUser:{$this->username} a foaf:Person .
      			OPTIONAL { dUser:{$this->username} ?isVegetarian diet:Vegetarian }
      			OPTIONAL { dUser:{$this->username} ?isVegan diet:Vegan }
      		",
      		'single' => 1
      	);

      	$result = $arcDb->query2($query);

      	$this->isVegetarian = $result['isVegetarian'] ? 'checked' : '';
      	$this->isVegan = $result['isVegan'] ? 'checked' : '';
	}

	public function store() {
		global $arcDb;

		$triples = array();

		if ( $this->isVegetarian ) {
			$triples[] = "dUser:{$this->username} a diet:Vegetarian";
		}
		if ( $this->isVegan ) {
			$triples[] = "dUser:{$this->username} a diet:Vegan";
		}

		return ( sizeof($triples) > 0 ) ? $arcDb->insert($triples) : 1;
	}
}

?>
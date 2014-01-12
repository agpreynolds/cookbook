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

	public function store() {
		global $arcDb;

		$triples = array();

		if ( $this->isVegetarian ) {
			$triples[] = "dUser:{$this->username} a dUserRestricted:Vegetarian";
		}
		if ( $this->isVegan ) {
			$triples[] = "dUser:{$this->username} a dUserRestricted:Vegan";
		}
		if ( $this->isLactoseIntolerant) {
			$triples[] = "dUser:{$this->username} a dUserRestricted:LactoseIntolerant";
		}

		return ( sizeof($triples) > 0 ) ? $arcDb->insert($triples) : 1;
	}
}

?>
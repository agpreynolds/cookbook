<?php

class ingredient {
	public $uri;
	public $name;
	public $quantity;
	public $foodGroup;
	public $insertSuccessful;

	public function __construct($data) {
		foreach($data as $key => $value){
        	$this->{$key} = $value;
      	}

      	//If the uri is not set we can generate it from the name
		if (!isset($this->uri) && isset($this->name)) {
			$this->uri = preg_replace('/\s+/', '', $this->name);
		}

		if ( $this->exists() ) {
			$this->insertSuccessful = 1;
		}
		elseif ( $this->store() ){
			$this->insertSuccessful = 1;
		}	
	}

	private function exists() {
		global $arcDb;

		$result = $arcDb->query2(array(
			'select' => array(
				'?label'
			),
			'where' => "dFood:{$this->uri} a recipe:Food ;
				rdfs:label ?label",
			'single' => 1
		));

		return ( $result ) ? 1 : 0;
	}

	private function store() {
		global $arcDb;

		$triples = array(
			"dFood:{$this->uri} a recipe:Food ;",
			"rdfs:label '{$this->name}'"
		);

		return $result = $arcDb->insert( $triples );
	}
}

?>
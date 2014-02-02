<?php

class review {
	public $uri;
	public $reviewer;
	public $title;
	public $text;
	public $comments;

	/*
		Class Construct
	*/
	public function review($data) {
		foreach($data as $key => $value){
        	$this->{$key} = $value;
      	}
	}
	public function store() {
		global $arcDb;

		$this->uri = generateUniqueID('review');

		$triples = array(
			"dReview:{$this->uri} a rev:Review ;",
			"rev:reviewer dUser:{$this->reviewer} ;",
			"rev:title '{$this->title}' ;",
			"rev:text '{$this->text}'"
		);

		$arcDb->insert( $triples );

		if ( isset($this->subject) ) {
			$this->attach();
		}
	}

	public function attach() {
		global $arcDb;

		$triples = array(
			"dRecipe:{$this->subject} rev:hasReview dReview:{$this->uri}"
		);

		$arcDb->insert( $triples );
	}
}

?>
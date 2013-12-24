<?php

class facet {
	public $id;
	public $label;
	public $active;
	public $mapsTo;
	public $shortcut;
	public $options;

	public function __construct($id) {
		$this->id = $id;
		$this->config = getConfig('facet');

		foreach ($this->config[$id] as $key => $value) {
        	$this->{$key} = $value;
      	}
		
		if ( !$this->options ) {
			$this->getOptions();
		}			
	}

	public function getOptions() {
		global $arcDb;
		$queryData = array(
			'select' => array(
				'?displayName'
			),
			'where' => "?facet a {$this->id} ;
				rdfs:label ?displayName"
		);

		$result = $arcDb->query2($queryData);
		
		foreach ($result as $option) {
			$this->options[] = $option['displayName'];			
		}		
	}
}
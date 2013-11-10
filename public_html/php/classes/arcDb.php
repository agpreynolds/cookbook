<?php

class arcDb {
	private $config;
	private $store;
	//private $endPoint;

	public function __construct() {
		$this->config = getConfig('arcDb');
		$this->store = ARC2::getStore($this->config);
		//$this->endPoint = ARC2::getStoreEndpoint($this->config);

		if ( !$this->store->isSetup() ) {
			$this->store->setUp();
		}

		// if ( !$this->endPoint->isSetup() ) {
		// 	$this->endPoint->setUp();
		// }

		// $this->endPoint->go();

		$this->store->query('LOAD <file://' . $_SERVER['DOCUMENT_ROOT'] . '/php/data/rdf/test.ttl>');
		
		$this->query('PREFIX foaf: <http://xmlns.com/foaf/0.1/> .
  			SELECT ?person ?name WHERE {
    			?person a foaf:Person; foaf:name ?name .
  			}');
		$this->query('PREFIX recipe: <http://linkedrecipes.org/schema/> .
			SELECT ?recipe ?cuisine ?xyz WHERE {
				?recipe a recipe:Recipe;
				recipe:cuisine ?cuisine;
				recipe:xyz ?xyz .
			}');		
	}
	public function query($sparql) {
		$result = $this->store->query($sparql, 'rows');

		echo $sparql;
		var_dump($result);
		return $result;
	}
}

?>
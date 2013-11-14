<?php

class arcDb {
	private $config;
	private $store;

	public function __construct() {
		$this->config = getConfig('arcDb');
		$this->store = ARC2::getStore($this->config);

		if ( !$this->store->isSetup() ) {
			$this->store->setUp();
		}

		$this->store->query('LOAD <file://' . $_SERVER['DOCUMENT_ROOT'] . '/php/data/rdf/test.ttl>');
	}
	public function query($sparql) {
		$result = $this->store->query($sparql, 'rows');

		echo $sparql;
		var_dump($result);
		return $result;
	}

	public function query2($args) {
		if (!$args) { return; }

		if ($args['prefix']) {
			$sparql = "PREFIX {$args['prefix']} .";
		}

		$sparql .= "SELECT ?recipe ?name ?cuisine WHERE { ?recipe a recipe:Recipe; recipe:name ?name; recipe:cuisine ?cuisine;";
		$sparql .= "FILTER regex(?cuisine, '{$args['cuisine']}') }";

		$result = $this->store->query($sparql,'rows');
		return $result;
	}
}

?>
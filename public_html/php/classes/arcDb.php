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

		if ($args['prefixes']) {
			$sparql = "PREFIX {$args['prefixes']} .";
		}

		$sparql .= "SELECT ?recipe ?name ?cuisine WHERE { ?recipe a recipe:Recipe; recipe:name ?name; recipe:cuisine ?cuisine;";
		
		if ($args['filters']) {
			foreach ($args['filters'] as $filter => $value) {
				$sparql .= "FILTER regex($filter,'$value')";
			}
		}

		$sparql .= "}";

		$result = $this->store->query($sparql,'rows');
		return $result;
	}
}

?>
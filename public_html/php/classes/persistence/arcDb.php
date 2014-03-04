<?php

class arcDb {
	private $config;
	private $store;

	public function __construct() {
		$this->config = getConfig('arcDb');
		$this->store = ARC2::getStore($this->config);

		if ( !$this->store->isSetup() ) {
			$this->store->setUp();
			$this->store->query('LOAD <file://' . $_SERVER['DOCUMENT_ROOT'] . '/php/data/rdf/test.ttl>');
		}
		//echo $this->store->dump();
	}
	public function drop() {
		return $this->store->drop();
	}
	public function query($sparql) {
		$sparql = $this->attachDefaultPrefixes() . $sparql;

		$result = $this->store->query($sparql,'rows');

		return $result;
	}

	/*
		* Expected args:
			Required
				- select - array - output vars
				- where - string - triples to extract
			Optional
				- single - returns a single row if specified
				- distinct - eliminates duplicates
	*/
	public function query2($args) {
		if (!$args) { return; }

		$sparql = $this->attachDefaultPrefixes();
		
		$sparql .= "SELECT ";

		if ($args['distinct']) {
			$sparql .= 'DISTINCT ';
		}
		if ($args['select']) {
			foreach ($args['select'] as $prop) {
				$sparql .= $prop . ' ';
			}
		}
		else {
			$sparql .= "*";
		}

		if ($args['where']) {
			$sparql .= "WHERE { {$args['where']} ";
		}

		$sparql .= "}";

		if ($args['group']) {
			$sparql .= "GROUP BY {$args['group']}";
		}

		$single = ( isset($args['single']) ) ? 'row' : 'rows';
		 // echo $sparql;
		$result = $this->store->query($sparql,$single);
		
		$this->handleError();

		return $result;
	}

	public function insert($triples) {
		$sparql = $this->attachDefaultPrefixes();

		$sparql .= "INSERT INTO <...> {";
		
		foreach ( $triples as $triple ) {
			$sparql .= $triple;			
		} 

		$sparql .= "}";
		 // echo $sparql;
		return $this->store->query($sparql,'',true);
	}

	private function attachDefaultPrefixes() {
		$OUT = '';
		if ($this->config['prefixes']) {
			foreach ($this->config['prefixes'] as $prefix) {
				$OUT .= "PREFIX {$prefix} . \n";				
			}
		}
		return $OUT;
	}

	private function handleError() {
		global $response;

		$errors = $this->store->getErrors();
		
		if ($errors) {
			foreach ($errors as $error) {
				$response->setMessage(array(
					'key' => 'arc_db',
					'text' => $error,
					'field' => ''
				));
			}
		}
	}
}

?>
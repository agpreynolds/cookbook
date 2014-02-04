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
	*/
	public function query2($args) {
		if (!$args) { return; }

		$sparql = $this->attachDefaultPrefixes();
		
		$sparql .= "SELECT ";
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

		if (isset($args['filters'])) {
			foreach ($args['filters'] as $filter => $choices) {
				if (is_array($choices)) {
					$length = count($choices);
					$i = 0;
					foreach ($choices as $value) {
						$i++;
						if (is_string($value)) {
							$last = ( $i == $length ) ? 1 : 0;
							$sparql .= $this->optionalFilterString($filter,$value,$last);
						}
						//TODO: Numerical Comparison
					}
				}
				else {
					$sparql .= $this->filterString($filter,$choices);
				}
			}
		}

		$sparql .= "}";

		$single = ( isset($args['single']) ) ? 'row' : 'rows';
		// echo $sparql;
		return $result = $this->store->query($sparql,$single);
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

	private function filterString($filter,$value) {
		return ". $filter rdfs:label '$value'";
	}
	private function optionalFilterString($filter,$value,$last) {
		return "{ $filter rdfs:label '$value'}" . ( !$last ? ' UNION' : '' );
	}
}

?>
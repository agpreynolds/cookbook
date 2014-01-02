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

		 // $this->store->drop();
	}
	public function query($sparql) {
		$result = $this->store->query($sparql,'rows');

		return $result;
	}

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
			}
		}

		$sparql .= "}";
		// echo $sparql;
		return $result = $this->store->query($sparql,'rows');
	}

	public function insert($triples) {
		$sparql = $this->attachDefaultPrefixes();

		$sparql .= "INSERT INTO <...> { $triples }";
		
		return $result = $this->store->query($sparql);
	}

	private function attachDefaultPrefixes() {
		$OUT = '';
		if ($this->config['prefixes']) {
			foreach ($this->config['prefixes'] as $prefix)
			$OUT .= "PREFIX {$prefix} . \n";
		}
		return $OUT;
	}

	private function filterString($filter,$value) {
		return "$filter rdfs:label '$value'";
	}
	private function optionalFilterString($filter,$value,$last) {
		return "{ $filter rdfs:label '$value'}" . ( !$last ? ' UNION' : '' );
	}
}

?>
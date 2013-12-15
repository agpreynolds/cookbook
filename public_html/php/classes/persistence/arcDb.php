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
		$result = $this->store->query($sparql,'rows');

		echo $sparql;
		var_dump($result);
		return $result;
	}

	public function query2($args) {
		if (!$args) { return; }

		if ($args['prefixes']) {
			$sparql = "PREFIX {$args['prefixes']} .";
		}

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
		//echo $sparql;
		$result = $this->store->query($sparql,'rows');
		return $result;
	}

	private function filterString($filter,$value) {
		return "$filter rdfs:label '$value'";
	}
	private function optionalFilterString($filter,$value,$last) {
		return "{ $filter rdfs:label '$value'}" . ( !$last ? ' UNION' : '' );
	}
}

?>
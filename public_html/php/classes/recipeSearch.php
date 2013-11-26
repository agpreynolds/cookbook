<?php

class recipeSearch {
	private $recipes = array();
	private $results;
	private $config;
	private $queryData;

	public function __construct($data) {
		$this->config = getConfig('search');
		$this->generateQueryData($data);

		$db = new arcDb();
		$this->results = $db->query2($this->queryData);

		foreach ( $this->results as $result ) {
			$this->recipes[] = new recipe($result);
		}
	}

	private function generateQueryData($data) {
		$this->queryData = array(
			'prefixes' => 'recipe: <http://linkedrecipes.org/schema/>',
			'filters' => array()
		);

		foreach ($data as $param => $value) {
			$config = $this->config[$param];
			if ($config && $config['mapsTo'] && $config['active']) {
				$this->queryData['filters'][$config['mapsTo']] = strtolower($value[0]);
			}
		}		
	}

	public function getRecipes() {
		return $this->recipes;
	}
	public function getResults() {
		return $this->results;
	}
}

?>
<?php

class searchOptions {
	private $options = array();

	public function __construct() {
		$config = getConfig('search');

		foreach ($config as $key => $value) {
			$facet = new facet($key,$value);
			if ($facet->active) {
				include ( getAbsIncPath('/templates/searchPanels/facet.php') );
			}
		}
	}

	public function outputFacetOptions($options) {
		foreach ($options as $opt) {
			include ( getAbsIncPath('/templates/searchPanels/includes/facetOption.php') );
		}
	}
}

?>
<?php

class searchOptions {
	public function __construct() {
		$config = getConfig('search');

		foreach ($config as $option) {
			$facet = new facet($option);
			include ( getAbsIncPath('/templates/searchPanels/facet.php') );			
		}
	}

	public function outputFacetOptions($options) {
		foreach ($options as $uri => $label) {
			include ( getAbsIncPath('/templates/searchPanels/includes/facetOption.php') );
		}
	}
}

?>
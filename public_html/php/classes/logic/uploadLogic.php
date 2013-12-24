<?php

class uploadLogic {
	public function __construct() {

	}
	public function outputFacetOptions($id) {
		$facet = new facet($id);
		foreach ($facet->options as $item) {
			include ( getAbsIncPath('/templates/includes/selectOption.php') );
		}
	}
}

?>
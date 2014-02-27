<?php

class uploadLogic {
	public function __construct() {

	}
	public function outputFacetOptions($id) {
		$facet = new facet($id);
		ob_start();
		foreach ($facet->options as $item) {
			$html .= include ( getAbsIncPath('/templates/includes/selectOption.php') );
		}
		return ob_get_clean();
	}
}

?>
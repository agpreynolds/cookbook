<?php

class searchResults {
	private $recipes;
	
	public function __construct($recipes) {
		$this->outputHTML($recipes);
	}

	public function outputHTML($recipes) {		
		ob_start();
		foreach ($recipes as $recipe ) {
			$recipe = new recipe($recipe);
			$class = ( $recipe->username === $_SESSION['user']->username ) ? 'userCreated' : '';
			include( getAbsIncPath('/templates/searchPanels/resultSmall/resultItem.php') );
		}
	}
}

?>
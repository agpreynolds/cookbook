<?php

class resultLogic {
	private $result;

	public function __construct($result) {
		$this->result = $result;
	}

	public function outputIngredientList() {
		foreach ($this->result->ingredients as $ing) {
			include ( getAbsIncPath('/templates/searchPanels/resultLarge/ingredientItem.php') );
		}
	}
	public function outputToolList() {
		foreach ($this->result->tools as $tool) {
			include ( getAbsIncPath('/templates/searchPanels/resultLarge/toolItem.php') );
		}
	}
	public function outputTechniqueList() {
		foreach ($this->result->techniques as $tec) {
			include ( getAbsIncPath('/templates/searchPanels/resultLarge/techniqueItem.php') );
		}
	}
	public function outputStepList() {
		foreach ($this->result->steps as $step) {
			include ( getAbsIncPath('/templates/searchPanels/resultLarge/stepItem.php') );
		}
	}
}

?>
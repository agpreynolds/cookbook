<?php

class ingredient {
	private $name;
	private $foodGroup;
	private $description;
	private $price;

	public function __construct() {

	}

	public function getFoodGroup() {
		return $this->foodGroup;
	}
}

?>
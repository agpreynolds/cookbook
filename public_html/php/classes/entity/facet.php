<?php

class facet {
	public $id;
	public $label;
	public $active;
	public $mapsTo;
	public $options;

	public function __construct($id,$details) {
		$this->id = $id;
		$this->label = $details['label'];
		$this->active = $details['active'];
		$this->mapsTo = $details['mapsTo'];
		$this->options = $details['options'];
	}

	public function outputOptions() {
		include( getAbsIncPath('/templates/') );
	}
}
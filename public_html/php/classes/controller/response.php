<?php

class response {
	public $messages;
	public $status;
	public $action;
	public $data;
	public $returnJSON;

	public function __construct() {
		$this->messages = array();
	}

	public function setMessage($obj) {
		$this->messages[] = $obj;
	}

	public function output() {
		if ( $this->returnJSON ) {
			echo $this->toJSON();			
		}
	}
	private function toJSON() {
		return json_encode(
			array(
				'messages' => $this->messages,
				'status' => $this->status,
				'action' => $this->action,
				'data' => $this->data,
				'html' => ob_get_clean()
			)
		);
	}
}

?>
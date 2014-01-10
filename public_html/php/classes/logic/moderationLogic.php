<?php

class moderationLogic {
	public $subject;
	
	public function __construct($data) {
		foreach($data as $key => $value){
        	$this->{$key} = $value;
      	}
	}	
}

?>
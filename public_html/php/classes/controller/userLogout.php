<?php

class userLogout {
	
	public function __construct($data) {
		global $session;
		$session->stop();
	}
}

?>
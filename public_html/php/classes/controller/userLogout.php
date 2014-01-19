<?php

class userLogout extends validateForm {
	/*
		* Function should exist in all subclasses of validateForm
	*/
	protected function run() {
		$this->logout();
	}
	private function logout() {
		global $session;
		$session->stop();		
	}
}

?>
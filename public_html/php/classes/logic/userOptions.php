<?php

class userOptions {
	public function __construct() {
		$this->outputUserOptions();
	}
	private function outputUserOptions() {
		if ( $_SESSION['user']->isSignedIn ) {
			include ( getAbsIncPath('/templates/userPanels/userAccount.php') );
		}
		else {
			include ( getAbsIncPath('/templates/userPanels/userLogin.php') );
		}
	}
}

?>
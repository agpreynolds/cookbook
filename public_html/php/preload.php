<?php

include( $_SERVER['DOCUMENT_ROOT'] . '/php/lib/lib.php' );

requireAbs_once('/php/lib/arc2/ARC2.php');

function __autoload($class_name) {
	$folders = array('controller','entity','logic','persistence');
	foreach ($folders as $folder) {
		$includePath = getAbsIncPath('/php/classes/' . $folder . '/' . $class_name . '.php');
		if ( file_exists( $includePath ) ) {
			include ( $includePath );
			break;
		}
	}
}

$db = new db();
$arcDb = new arcDb();
$session = new session();

if (!isset($_SESSION['user'])) {
	$_SESSION['user'] = new user();
}

$request = new request();

?>
<?php

include( $_SERVER['DOCUMENT_ROOT'] . '/php/lib/lib.php' );

requireAbs_once('/php/lib/arc2/ARC2.php');

function __autoload($class_name) {
	include ( getAbsIncPath('/php/classes/controller/' . $class_name . '.php' ) );
	include ( getAbsIncPath('/php/classes/entity/' . $class_name . '.php' ) );
	include ( getAbsIncPath('/php/classes/persistence/' . $class_name . '.php' ) );	
}

$request = new request();

?>
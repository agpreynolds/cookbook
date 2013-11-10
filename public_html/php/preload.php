<?php

include( $_SERVER['DOCUMENT_ROOT'] . '/php/lib/lib.php' );

requireAbs_once('/php/lib/arc2/ARC2.php');

function __autoload($class_name) {
	requireAbs_once('/php/classes/' . $class_name . '.php');
}

$request = new request();

?>
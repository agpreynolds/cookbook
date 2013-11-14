<?php

function includeAbs($path) {
	return include($_SERVER['DOCUMENT_ROOT'] . $path );
}

function getAbsIncPath($path) {
	return $_SERVER['DOCUMENT_ROOT'] . $path;	
}
function requireAbs_once($path) {
	return require_once($_SERVER['DOCUMENT_ROOT'] . $path );
}

function getConfig($config) {
	$path = '/php/configuration/' . $config . '.php';
	return requireAbs_once($path);
}

function encrypt($arg) {
	return md5($arg);
}

?>
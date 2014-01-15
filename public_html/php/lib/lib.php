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
function requireAbs($path) {
	return require($_SERVER['DOCUMENT_ROOT'] . $path );
}

function getConfig($config) {
	$path = '/php/configuration/' . $config . '.php';
	return requireAbs($path);
}

function getForm($id) {
	$path = '/php/forms/' . $id . '.php';
	return require ( getAbsIncPath($path) );
}

function getImageExtension($path) {
	$validExtensions = array('jpg','JPG','png');
	foreach ($validExtensions as $ext) {
		if ( file_exists($_SERVER['DOCUMENT_ROOT'] . $path . '.' . $ext) ) {
			return $ext; 
		}
	}
	return 0;
}

function encrypt($arg) {
	return md5($arg);
}

?>
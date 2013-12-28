<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/php/preload.php');
$recipeSearch = $request->response;
$results = new searchResults($recipeSearch);

$results->outputHTML();
$results->returnJSON();
?>

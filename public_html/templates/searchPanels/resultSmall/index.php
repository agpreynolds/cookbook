<?php
$recipeSearch = $request->response;
$results = new searchResults($recipeSearch);

$results->outputHTML();
$results->returnJSON();
?>

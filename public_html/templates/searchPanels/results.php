<?php

$search = $request->response;
$recipes = $search->getRecipes();

foreach ($recipes as $recipe ) {
	include( getAbsIncPath('/templates/searchPanels/includes/resultSmall.php') );
}

?>
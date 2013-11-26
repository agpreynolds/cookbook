<?php

$search = $request->response;
$recipes = $search->getRecipes();
$resultData = $search->getResults();

ob_start();

echo "<ul>";

foreach ($recipes as $recipe ) {
	include( getAbsIncPath('/templates/searchPanels/includes/resultSmall.php') );
}

echo "</ul>";

echo json_encode(
	array(
		'data' => $resultData,
		'html' => ob_get_clean()
	)
);

?>
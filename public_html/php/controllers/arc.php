<?php

include ($_SERVER['DOCUMENT_ROOT'] . '/php/preload.php');

global $arcDb;


$ingredientsQuery = array(
			'select' => array(
				'?quantity',
				'?food'
			),
			'where' => "
				dRecipe:SultanaCake a recipe:Recipe ;
				recipe:ingredients ?ingredients .
				?ingredients ?p ?s .
				?s a recipe:Ingredient ;
				recipe:quantity ?quantity ;
				recipe:food ?food
			"
		);

$result = $arcDb->query2($ingredientsQuery);
var_dump($result);


?>
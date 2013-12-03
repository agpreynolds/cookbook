<?php

$db = new arcDb();

$queryData = array(
	'prefixes' => "recipe: <http://linkedrecipes.org/schema/>",
	'where' => "?recipe a recipe:Recipe ; recipe:cuisine ?cuisine ; recipe:course ?course ; recipe:time ?time .",
	'filters' => array( 
		'?cuisine' => array('Italian'),
		'?course' => array('Starter')
	)
);

	// $queryData = array(
	// 	'prefixes' => "recipe: <http://linkedrecipes.org/schema/>",
	// 	'where' => "
	// 		?recipe a recipe:Recipe ; 
	// 		recipe:ingredients ?ingredients 			
	// 	"
	// 	'where' => "
	// 		?recipe a recipe:Recipe ;
	// 		recipe:cuisine ?cuisine . 
	// 		?cuisine rdfs:label ?lab
	// 	"
	//);

$result = $db->query2($queryData);

$describe = "DESCRIBE <http://palacealex.com/data/Recipe/SultanaCake>";
//$result = $db->query($describe);

var_dump($result);

?>
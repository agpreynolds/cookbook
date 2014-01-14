<?php

include ($_SERVER['DOCUMENT_ROOT'] . '/php/preload.php');

global $arcDb;



	$query = array(
			'select' => array(
				'?recipe',
				'?ingredients'				
			),
			'where' => "
				?ingredient a recipe:Food ; 
				rdfs:label ?label				
			"
		);
// $q = array(
// 			'select' => array(
// 				'?recipe',
// 				'?label',
// 				'?comment',
// 				'?author',
// 				'?cuisine',
// 				'?course'
// 			),
// 			'where' => "?recipe a recipe:Recipe ; 
// 				rdfs:label ?label ;
// 				rdfs:comment ?comment ;
// 				recipe:cuisine ?cuisine ;
// 				recipe:course ?course ;
// 				rdf:author ?auth .
// 				?auth rdfs:label ?author",
// 			'filters' => array()
// 		);
// $result = $arcDb->query2($query);
// var_dump($result);

//$result = $db->query2($queryData);

$q = "PREFIX recipe:<http://linkedrecipes.org/schema/> .
PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#> .
SELECT ?label ?food ?quantity
WHERE { ?recipe a recipe:Recipe ;
	rdfs:label ?label ;
	recipe:ingredients ?ingredients .
	?ingredients ?p ?s .
	?s a recipe:Ingredient ;
	recipe:food ?food ;
	recipe:quantity ?quantity
}";

$result = $arcDb->query($q);
var_dump($result);



?>
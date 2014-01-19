<?php

include ($_SERVER['DOCUMENT_ROOT'] . '/php/preload.php');

global $arcDb;


$query = array(
			'select' => array(
				'?recipe',
				'?ingredient',
				'?quantity'
			),
			'where' => "
				?recipe a recipe:Recipe ; 
				recipe:ingredients ?ingredients .
				?ingredients ?p ?s .
				?s a recipe:Ingredient ;
				recipe:quantity ?quantity ;
				recipe:food ?food .
				?food rdfs:label ?ingredient 
			"
		);

// $query = "SELECT ?o WHERE { <http://palacealex.com/data/Food/Sultana> rdfs:label ?o }";
// $result = $arcDb->query($query);
// var_dump($result);
	
	// $query = array(
	// 		'select' => array(
	// 			'?recipe',
	// 			'?ingredients'				
	// 		),
	// 		'where' => "
	// 			?ingredient a recipe:Food ; 
	// 			rdfs:label ?label				
	// 		"
	// 	);
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
$result = $arcDb->query2($query);
var_dump($result);

//$result = $db->query2($queryData);

// $q = "PREFIX recipe:<http://linkedrecipes.org/schema/> .
// PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#> .
// SELECT ?label ?food ?quantity ?name
// WHERE { ?recipe a recipe:Recipe ;
// 	rdfs:label ?label ;
// 	recipe:ingredients ?ingredients .
// 	?ingredients ?p ?s .
// 	?s a recipe:Ingredient ;
// 	recipe:food ?food ;
// 	rdfs:label ?name
// }";

// $result = $arcDb->query($q);
// echo json_encode($result);



?>
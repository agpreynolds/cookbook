<?php

include ($_SERVER['DOCUMENT_ROOT'] . '/php/preload.php');

global $arcDb;



	$q = array(
			'select' => array(
				'?recipe',
				'?name',
				'?cuisine',
				'?course',
				'?s'
			),
			'prefixes' => 'recipe: <http://linkedrecipes.org/schema/>',
			'where' => "
				?recipe a recipe:Recipe ; 
				rdfs:label ?name ;
				recipe:cuisine ?cuisine ;
				recipe:course ?course ;
				recipe:ingredients ?ingredientList .
				?ingredientList ?p ?s .
				?s a recipe:Ingredient
			",
			'filters' => array()
		);

	$q = "PREFIX recipe: <http://linkedrecipes.org/schema/> . 
	SELECT ?recipe (GROUP_CONCAT(?food) as ?ing)
	WHERE {
		?recipe a recipe:Recipe ; 
		recipe:ingredients ?ingredientList .
		?ingredientList ?p ?s .
		?s a recipe:Ingredient ;
		recipe:food ?food
	}
	";

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
$result = $arcDb->query($q);
var_dump($result);

//$result = $db->query2($queryData);

// $q = "PREFIX recipe:<http://linkedrecipes.org/schema/> .
// PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#> .
// SELECT ?food ?quantity
// WHERE { ?recipe a recipe:Recipe ;
// 	recipe:ingredients ?ingredients .
// 	?ingredients ?p ?s .
// 	?s a recipe:Ingredient ;
// 	recipe:food ?food ;
// 	recipe:quantity ?quantity
// }";



?>
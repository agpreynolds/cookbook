<?php

$db = new arcDb();



	$q = array(
			'select' => array(
				'?recipe',
				'?name',
				'?cuisine',
				'?course',
				'?food',
				'?quantity'
			),
			'prefixes' => 'recipe: <http://linkedrecipes.org/schema/>',
			'where' => "?recipe a recipe:Recipe ; 
				rdfs:label ?name ;
				recipe:cuisine ?cuisine ;
				recipe:course ?course ;
				recipe:ingredients ?ingredientList .
				?ingredientList ?p ?s .
				?s a recipe:Ingredient ;
				recipe:food ?food ;
				recipe:quantity ?quantity",
			'filters' => array()
		);

//$result = $db->query2($queryData);

$describe = "DESCRIBE <http://palacealex.com/data/Recipe/SultanaCake>";
//$result = $db->query($describe);

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

$result = $db->query2($q);

var_dump($result);

?>
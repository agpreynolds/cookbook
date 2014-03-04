<?php

include ($_SERVER['DOCUMENT_ROOT'] . '/php/preload.php');

global $arcDb;

$recipe = [
      'label' => 'hello',
      'hasSeafood' => 1
];

if (!isset($recipe['hasMeat']) 
      && !isset($recipe['hasSeafood']) 
      && !isset($recipe['hasEgg']) 
      && !isset($recipe['hasDairy']) ) {
      echo "true";
}

$query = array(
      'select' => array(
            '?uri',
            '?label',
            '?group',
            '?seaFood'
      ),
      'where' => "?uri a recipe:Recipe ;
            rdfs:label ?label ;
            recipe:ingredients ?ingredients .
            ?ingredients ?p ?s .
            ?s a recipe:Ingredient ;
            recipe:food ?food .
            OPTIONAL { ?food ?group dFoodGroup:Meat }
            OPTIONAL { ?food ?seaFood dFoodGroup:SeaFood }
      ",                  
      'distinct' => 1,
      'group' => '?uri'
);
            // MINUS { ?food dClass:foodGroup dFoodGroup:Meat }

$result = $arcDb->query2($query);
var_dump($result);

global $response;
$response->returnJSON = 1;
 // $response->output();

?>
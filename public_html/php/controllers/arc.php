<?php

include ($_SERVER['DOCUMENT_ROOT'] . '/php/preload.php');

global $arcDb;

$query = array(
      'select' => array(
            '?uri',
            '?label',
            '?group'
      ),
      'where' => "?uri a recipe:Recipe ;
            rdfs:label ?label ;
            recipe:ingredients ?ingredients .
            ?ingredients ?p ?s .
            ?s a recipe:Ingredient ;
            recipe:food ?food .
            OPTIONAL { 
                  ?food ?group dFoodGroup:Meat
            }            
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
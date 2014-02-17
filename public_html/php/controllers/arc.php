<?php

include ($_SERVER['DOCUMENT_ROOT'] . '/php/preload.php');

global $arcDb;

$query = array(
      'select' => array(
            '?uri',
            '?label',
            '?username'
      ),
      'where' => "?uri a recipe:Recipe ;
            rdfs:label ?label ;
            rdf:author ?author ;
            recipe:cuisine dCuisine:Chinese ;
            recipe:cuisine dCuisine:Italian .
            ?author rdfs:label ?username",                  
      'distinct' => 1
);

$result = $arcDb->query2($query);
var_dump($result);

global $response;
$response->returnJSON = 1;
$response->output();

?>
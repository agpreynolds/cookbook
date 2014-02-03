<?php

include ($_SERVER['DOCUMENT_ROOT'] . '/php/preload.php');

global $arcDb;


$query = array(
      		'select' => array(
      			'?username',
      			'?isVegetarian'
      		),
      		'where' => "
      			dUser:alex a foaf:Person ;
      			rdfs:label ?username .
      			OPTIONAL { dUser:alex ?isVegetarian diet:Vegetarian }
      		"
      	);

$result = $arcDb->query2($query);
var_dump($result);


?>
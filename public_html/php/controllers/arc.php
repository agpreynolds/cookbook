<?php

include ($_SERVER['DOCUMENT_ROOT'] . '/php/preload.php');

global $arcDb;


$query = array(
                  'select' => array(
                        '?uri',
                        '?label',
                        '?username'
                  ),
                  'where' => "
                        ?uri a recipe:Recipe ; 
                        rdfs:label ?label ;
                        rdfs:comment ?comment ;
                        recipe:cuisine ?cuisine ;
                        recipe:course ?course ;
                        rdf:author ?author ;                
                        recipe:ingredients ?ingredients .
                        ?ingredients ?p ?s .
                        ?s a recipe:Ingredient ;
                        recipe:quantity ?quantity ;
                        recipe:food ?food .                        
                        ?author rdfs:label ?username
                  ",
                  'filters' => array(
                        '?food' => array('Chicken'),
                        '?course' => array('Main')
                  ),
                  'distinct' => 1
);

$result = $arcDb->query2($query);
var_dump($result);


?>
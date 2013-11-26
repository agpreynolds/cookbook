<?php

$db = new arcDb();

$queryData = array(
	'prefixes' => 'recipe: <http://linkedrecipes.org/schema/>',
	'filters' => array(
		'?cuisine' => 'chinese'
	)
);

$result = $db->query2($queryData);

var_dump($result);

?>
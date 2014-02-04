<?php

return array(
	'name' => 'recipeSearch',
	'fields' => array(
		'recipe:Cuisine' => array(
			'type' => 'array'			
		),
		'recipe:Course' => array(
			'type' => 'array'			
		)
	),
	'errors' => array(
		
	),
	'onSuccess' => "global.recipeSearch.onSuccess"
);

?>
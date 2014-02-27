<?php

return array(
	'name' => 'recipeSearch',
	'fields' => array(
		'recipe:Cuisine' => array(
			'type' => 'array'			
		),
		'recipe:Cuisine_type' => array(
			'type' => 'radio',
			'validators' => array(
				'required' => 1
			)
		),
		'recipe:Course' => array(
			'type' => 'array'			
		),
		'recipe:Course_type' => array(
			'type' => 'radio',
			'validators' => array(
				'required' => 1
			)
		),
		'recipe:Food' => array(
			'type' => 'array'
		),
		'recipe:Food_type' => array(
			'type' => 'radio',
			'validators' => array(
				'required' => 1
			)
		),
	),
	'errors' => array(
		'db_failure' => 'No Results Found'
	),
	'onSuccess' => "global.recipeSearch.onSuccess",
	'onError' => "global.recipeSearch.onError"
);

?>
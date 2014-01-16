<?php

return array(
	'name' => 'recipeCreate',
	'fields' => array(
		'label' => array(
			'type' => 'text',
			'validators' => array(
				'required' => 1,
				'maxLength' => 30
			)
		),
		'comment' => array(
			'type' => 'textarea',
			'validators' => array(
				'required' => 1
			)
		),
		'cuisine' => array(
			'type' => 'select',
			'validators' => array(
				'required' => 1
			)
		),
		'course' => array(
			'type' => 'select',
			'validators' => array(
				'required' => 1
			)
		),
		'ingredients' => array(
			'type' => 'array',
			'validators' => array(
				'minLength' => 2
			)
		),
		'quantity' => array(
			'type' => 'array',
			'validators' => array(
				'minLength' => 2
			)
		)
	),
	'errors' => array(
		'required_label' => 'Please enter a name for your recipe',
		'required_comment' => 'Please enter a short description of your recipe',
		'required_cuisine' => 'Please select a cuisine',
		'required_course' => 'Please select a course',
		'maxLength_label' => 'Sorry, we can only accept recipe names containing 30 characters or less',
		'array_minLength_ingredients' => 'Please enter at least two ingredients',
		'array_minLength_quantity' => 'Please enter quantities for at least two ingredients',
		'user_notSignedIn' => 'Sorry, you must be signed in to upload a recipe, please sign in above to continue'
	),
	'onSuccess' => 'global.recipeCreate.onSuccess'	
);

?>
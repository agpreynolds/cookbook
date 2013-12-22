<?php

return array(
	'name' => 'recipeCreate',
	'fields' => array(
		'label' => array(
			'type' => 'text',
			'validators' => array(
				'required' => 1,
				'maxLength' => 15
			)
		),
		'description' => array(
			'type' => 'textarea',
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
		)
	),
	'errors' => array(
		'required_label' => 'Please enter a name for your recipe',
		'required_cuisine' => 'Please select a cuisine',
		'required_course' => 'Please select a course',
		'user_notSignedIn' => 'Sorry, you must be signed in to upload a recipe, please sign in above to continue'
	)	
);

?>
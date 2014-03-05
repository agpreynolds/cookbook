<?php

return array(
	'name' => 'recipeRating',
	'fields' => array(
		'subject' => array(
			'type' => 'hidden',
			'validators' => array(
				'required' => 1
			)
		),
		'reviewer' => array(
			'type' => 'text',
			'validators' => array(
				'required' => 1,
				'maxLength' => 15
			)
		),
		'rating' => array(
			'type' => 'numeric',
			'validators' => array(
				'required' => 1
			)
		)
	),
	'errors' => array(
		
	)	
);

?>
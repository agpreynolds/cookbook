<?php

return array(
	'name' => 'recipeCreate',
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
		'title' => array(
			'type' => 'text',
			'validators' => array(
				'required' => 1
			)
		),
		'text' => array(
			'type' => 'textarea',
			'validators' => array(
				'required' => 1
			)
		)
	),
	'errors' => array(
		'required_title' => 'Please add a title to your review',
		'required_text' => 'Please add some text to your review'		
	)	
);

?>
<?php

return array(
	'name' => 'recipeModerate',
	'fields' => array(
		'subject' => array(
			'type' => 'hidden',
			'validators' => array(
				'required' => 1
			)
		),
		'username' => array(
			'type' => 'text',
			'validators' => array(
				'required' => 1,
				'maxLength' => 15
			)
		),
		'comment' => array(
			'type' => 'textarea',
			'validators' => array(
				'required' => 1
			)
		)		
	),
	'errors' => array(
		
	)
);

?>
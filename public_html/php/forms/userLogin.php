<?php

return array(
	'name' => 'userLogin',
	'method' => 
	'fields' => array(
		'username' => array(
			'type' => 'text',
			'placeholder' => 'Username'
			'validators' => array(
				'required'
			)
		),
		'password' => array(
			'type' => 'password',
			'placeholder' => 'Password',
			'validators' => array(
				'required'
			)
		)
	)
);

?>
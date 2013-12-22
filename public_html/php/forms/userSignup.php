<?php

return array(
	'name' => 'userSignup',
	'fields' => array(
		'username' => array(
			'type' => 'text',
			'validators' => array(
				'required' => 1, 
				'maxLength' => 15
			)
		),
		'password' => array(
			'type' => 'password',
			'validators' => array(
				'required' => 1,
				'minLength' => 6,
				'maxLength' => 12
			)
		),
		'password2' => array(
			'type' => 'password',
			'validators' => array(
				'required' => 1,
				'minLength' => 6,
				'maxLength' => 12
			)
		),
		'terms' => array(
			'type' => 'checkbox',
			'validators' => array(
				'required' => 1
			)
		),
	),
	'validators' => array(
		'fieldsIdentical' => array('password','password2')
	),
	'onSuccess' => "global.user.signin"
);

?>
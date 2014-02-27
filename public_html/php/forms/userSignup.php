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
	'errors' => array(
		'required_username' => "Please enter a username.",
		'required_password' => "Please enter a password.",
		'required_password2' => "Please re-enter your password.",
		'required_terms' => "Please accept the terms of use.",
		'minLength_password' => "Your password must contain between 6 and 15 characters.",
		'minLength_password2' => "Your password must contain between 6 and 15 characters.",
		'maxLength_username' => "Please enter a username with less than 15 characters.",
		'maxLength_password' => "Your password must contain between 6 and 15 characters.",
		'maxLength_password2' => "Your password must contain between 6 and 15 characters.",
		'fieldsIdentical_password' => "The password fields must match."
	),
	'onSuccess' => "global.user.signin"
);

?>
<?php

return array(
	'name' => 'userLogin',
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
				'required' => 1
			)
		)
	),
	'errors' => array(
		'required_username' => "Please enter a username.",
		'required_password' => "Please enter a password.",
		'maxLength_username' => "Please enter a username with less than 15 characters.",
		'password_incorrect' => "The password you have entered is incorrect, please try again.",
		'user_isSignedIn' => "Login failed: There is already a user logged in, please clear your cache and cookies and try again.",
		'user_not_recognized' => "Sorry we don't have a user assosciated with that username, why not create an account?"
	),
	'onSuccess' => "global.user.signin",
	'onError' => "global.user.signinError"
);

?>
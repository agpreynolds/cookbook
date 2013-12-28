<?php

return array(
	'name' => 'userLogout',
	'fields' => array(
		'username' => array(
			'type' => 'hidden'
		)
	),
	'validators' => array(
		
	),
	'errors' => array(
		'user_notSignedIn' => 'Sorry you can only sign out if you are already signed in'
	),
	'onSuccess' => "global.user.signout"
);

?>
<?php

return array(
	'uploadPath' => $_SERVER['DOCUMENT_ROOT'] . '/media/userUploads/',
	'validators' => array(
		'fileSize' => '20000', //20kb
		'fileType' => array('image/jpg','image/png')
	)
);

?>
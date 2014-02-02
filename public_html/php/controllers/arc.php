<?php

include ($_SERVER['DOCUMENT_ROOT'] . '/php/preload.php');

global $arcDb;


$query = array(
			'select' => array(
				'?review',
				'?reviewer',
				'?title',
				'?text'
			),
			'where' => "
				?review a rev:Review ;
				rev:reviewer ?reviewer ;
				rev:title ?title ;
				rev:text ?text
			"
		);

$result = $arcDb->query2($query);
var_dump($result);


?>
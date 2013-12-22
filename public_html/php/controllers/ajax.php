<?php

$db = new db();

$insert = $db->insert(
	array(
		'table' => 'user',
		'values' => "'username','password'"
	)
);

?>
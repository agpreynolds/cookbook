<?php

include ($_SERVER['DOCUMENT_ROOT'] . '/php/preload.php');

global $arcDb , $db;

$arcDb->drop();

$db->dropUsers();

?>
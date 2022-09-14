<?php
require_once '../config/configoauth.php';

$arr = array('href' => "".$client->createAuthUrl()."");

echo json_encode($arr);
?>

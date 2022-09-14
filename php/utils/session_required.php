<?php

include_once '../config/configparameters.php';

session_start();

$now = time();
if (!isset($_SESSION)) {
    echo json_encode(['location' => $path_location]);
    exit();
} else if ($now > $_SESSION['expire']) {
    session_destroy();
    echo json_encode(['location' => $path_location]);
    exit();
} 
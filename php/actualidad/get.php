<?php
//including the database connection file
include_once("../config/configbd.php");

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$stmt = mysqli_prepare($mysqli, "SELECT * FROM actualidad WHERE actualidad_id = ?");
mysqli_stmt_bind_param($stmt, 's', $_GET['id']);

/* execute query */
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

echo json_encode($row);

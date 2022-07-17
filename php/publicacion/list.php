<?php
//including the database connection file
include_once("../config/configbd.php");
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$limit = 12;
$offset = 0;
$neoLimit =  isset($_GET['limit'])?$_GET['limit']:0;
$neoOffset =  isset($_GET['offset'])?$_GET['offset']:0;
if ($neoLimit > 0 && $neoLimit < 5) {
    $limit = $neoLimit;
}

if ($neoOffset > 0) {
    $offset = $neoOffset;
}

$stmt = mysqli_prepare($mysqli, "SELECT * FROM publicaciones WHERE activo=true ORDER BY fecha DESC LIMIT $offset,$limit");
//mysqli_stmt_bind_param($stmt,'variable', $limit);

/* execute query */
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$return_arr = array();

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $row_array['publicacion_id'] = $row['publicacion_id'];
    $row_array['fecha'] = $row['fecha'];
    $row_array['categoria'] = $row['categoria'];
    $row_array['codigo'] = $row['codigo'];

    array_push($return_arr, $row_array);
}

$stmt = mysqli_prepare($mysqli, "SELECT count(*) as conteo FROM publicaciones WHERE activo=true");
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = $result->fetch_assoc();

$final_resultado = array('resultados' => $return_arr, 'total' => $row['conteo']);

echo json_encode($final_resultado);

<?php
//including the database connection file
include_once("../config/configbd.php");
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$limit = 12;
$offset = 0;
$neoLimit =  $_GET['limit'];
$neoOffset =  $_GET['offset'];
$categoria =  $_GET['categoria'];
if ($neoLimit > 0 && $neoLimit < 5) {
    $limit = $neoLimit;
}

if ($neoOffset > 0) {
    $offset = $neoOffset;
}
if (empty($categoria)){
    $stmt = mysqli_prepare($mysqli, "SELECT * FROM luchadores WHERE activo=true ORDER BY prioridad ASC, fecha DESC LIMIT $offset,$limit");
   
}else{
    $categoria_sql = "%{$_GET['categoria']}%";
    $stmt = mysqli_prepare($mysqli,  "SELECT * FROM luchadores WHERE activo=true and categoria like ? ORDER BY prioridad ASC, fecha DESC LIMIT $offset,$limit");
    mysqli_stmt_bind_param($stmt, 's', $categoria_sql);
}

/* execute query */
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$return_arr = array();

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $row_array['luchadores_id'] = $row['luchadores_id'];
    $row_array['titulo'] = $row['titulo'];
    $row_array['subtitulo'] = $row['subtitulo'];
    $row_array['fecha'] = $row['fecha'];
    $row_array['categoria'] = $row['categoria'];
    $row_array['prioridad'] = $row['prioridad'];
    $row_array['url_imagen'] = $row['url_imagen'];
    $row_array['descripcion'] = $row['descripcion'];

    array_push($return_arr, $row_array);
}

if (empty($categoria)){
    $stmt = mysqli_prepare($mysqli, "SELECT count(*) as conteo FROM luchadores WHERE activo=true");
}else{
    $categoria_sql = "%{$_GET['categoria']}%";
    $stmt = mysqli_prepare($mysqli,  "SELECT count(*) as conteo FROM luchadores WHERE activo=true and categoria like ?");
    mysqli_stmt_bind_param($stmt, 's', $categoria_sql);
}
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = $result->fetch_assoc();

$final_resultado = array('resultados' => $return_arr, 'total' => $row['conteo']);

echo json_encode($final_resultado);

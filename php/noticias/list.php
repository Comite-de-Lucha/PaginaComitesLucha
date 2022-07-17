<?php
//including the database connection file
include_once("../config/configbd.php");
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$limit = 12;
$offset = 0;
$neoLimit =  isset($_GET['limit'])?$_GET['limit']:0;
$neoOffset =  isset($_GET['offset'])?$_GET['offset']:0;
$mes =   isset($_GET['mes'])?$_GET['mes']:null;
$anho =   isset($_GET['anho'])?$_GET['anho']:null;
if ($neoLimit > 0 && $neoLimit < 12) {
    $limit = $neoLimit;
}

if ($neoOffset > 0) {
    $offset = $neoOffset;
}
if (empty($mes)){
$stmt = mysqli_prepare($mysqli, "SELECT * FROM noticias WHERE activo=true ORDER BY fecha DESC LIMIT $offset,$limit");
}else{
    $stmt = mysqli_prepare($mysqli,  "SELECT * FROM noticias WHERE activo=true and YEAR(fecha) = ? and MONTH(fecha) = ? ORDER BY fecha DESC LIMIT $offset,$limit");
    mysqli_stmt_bind_param($stmt, 'ii', $anho, $mes);
}
//mysqli_stmt_bind_param($stmt,'variable', $limit);

/* execute query */
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$return_arr = array();

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $row_array['noticia_id'] = $row['noticia_id'];
    $row_array['titulo'] = $row['titulo'];
    $row_array['subtitulo'] = $row['subtitulo'];
    $row_array['fecha'] = $row['fecha'];
    $row_array['boton'] = $row['boton'];
    $row_array['url_imagen'] = $row['url_imagen'];
    $row_array['descripcion'] = $row['descripcion'];

    array_push($return_arr, $row_array);
}

if (empty($mes)){
$stmt = mysqli_prepare($mysqli, "SELECT count(*) as conteo FROM noticias WHERE activo=true");
}else{
    $stmt = mysqli_prepare($mysqli, "SELECT count(*) as conteo FROM noticias WHERE activo=true and YEAR(fecha) = ? and MONTH(fecha) = ?");
    mysqli_stmt_bind_param($stmt, 'ii', $anho, $mes);
}
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = $result->fetch_assoc();

$final_resultado = array('resultados' => $return_arr, 'total' => $row['conteo']);

echo json_encode($final_resultado);

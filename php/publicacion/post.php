<?php

include_once '../config/configbd.php';
include_once '../config/configparameters.php';


mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$fecha =  $_POST['fecha_publicacion'];
$categoria =  $_POST['categoria_publicacion'];
$codigo =  $_POST['codigo_publicacion'];
$id =  $_POST['id'];

if (empty($fecha)){
    $fecha=date('Y-m-d H:i:s');
}

if (empty($id)) {
    $stmt = mysqli_prepare($mysqli, "INSERT INTO publicaciones ( categoria, fecha,  codigo) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sss",  $categoria, $fecha, $codigo);
} else {
    $stmt = mysqli_prepare($mysqli, "UPDATE publicaciones SET categoria=?, fecha= ?, codigo = ? WHERE publicacion_id = ?");
    mysqli_stmt_bind_param($stmt, "sssi", $categoria, $fecha, $codigo, $id);
}
    /* execute query */
    mysqli_stmt_execute($stmt);

    echo json_encode(['resultado' => 'ok', 'publicacion' => $path_host]);
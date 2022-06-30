<?php

include_once '../config/configbd.php';
include_once '../config/configparameters.php';


mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$categoria =  $_POST['categoria_info'];
$prioridad =  $_POST['prioridad_info'];
$titulo =  $_POST['titulo_info'];
$subtitulo =  $_POST['subtitulo_info'];
$fecha =  $_POST['fecha_info'];
$descripcion =  $_POST['descripcion_info'];
$id =  $_POST['id'];

if (empty($fecha)){
    $fecha=date('Y-m-d H:i:s');
}

if (0 < $_FILES['imagen_info']['error']) {
    echo 'Error: ' . $_FILES['imagen_info']['error'] . '<br>';
} else {
    if (empty($_FILES['imagen_info']['name'])) {
        //Subir datos
        if (empty($id)) {
            $stmt = mysqli_prepare($mysqli, "INSERT INTO luchadores (titulo, subtitulo, categoria, prioridad, fecha,  descripcion) VALUES (?, ?, ?, ?, ?, ?)");
            mysqli_stmt_bind_param($stmt, "sssiss", $titulo, $subtitulo, $categoria, $prioridad, $fecha, $descripcion);
        } else {
            $stmt = mysqli_prepare($mysqli, "UPDATE luchadores SET titulo=? , subtitulo=?, categoria=?, prioridad=?, fecha= ?, descripcion = ? WHERE luchadores_id = ?");
            mysqli_stmt_bind_param($stmt, "sssissi", $titulo, $subtitulo,  $categoria, $prioridad, $fecha, $descripcion, $id);
        }
    } else {
        //Subir archivo
        $test = explode('.', $_FILES['imagen_info']['name']);
        $extension = end($test);
        $imgtitulo = preg_replace('/[^A-Za-z0-9\-]/', '', $titulo);
        $name = str_replace(' ', '_', $imgtitulo) . rand(100, 999) . '.' . $extension;
        $location = 'upload/' . $name;
        move_uploaded_file($_FILES['imagen_info']['tmp_name'], $location);
        $location = $path_luchadores . $location;

        //Subir datos
        if (empty($id)) {
            $stmt = mysqli_prepare($mysqli, "INSERT INTO luchadores (titulo, subtitulo, categoria, prioridad, fecha,  descripcion, url_imagen) VALUES (?, ?, ?, ?, ?, ?, ?)");
            mysqli_stmt_bind_param($stmt, "sssisss",$titulo, $subtitulo, $categoria, $prioridad, $fecha, $descripcion, $location);
        } else {
            $stmt = mysqli_prepare($mysqli, "UPDATE luchadores SET  titulo=? , subtitulo=?, categoria=?, prioridad=?, fecha= ?, descripcion = ?, url_imagen = ? WHERE luchadores_id = ?");
            mysqli_stmt_bind_param($stmt, "sssisssi",$titulo, $subtitulo, $categoria, $prioridad, $fecha, $descripcion, $location, $id);
        }
    }
    /* execute query */
    mysqli_stmt_execute($stmt);

    echo 'ok';
}
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
$publicacion =  $_POST['publicacion_info'];
$id =  $_POST['id'];

if (empty($fecha)){
    $fecha=date('Y-m-d H:i:s');
}

if (isset($_FILES['imagen_info']) && 0 < $_FILES['imagen_info']['error']) {
    echo 'Error: ' . $_FILES['imagen_info']['error'] . '<br>';
} else {
    if (!isset($_FILES['imagen_info'])) {
        //Subir datos
        if (empty($id)) {
            $stmt = mysqli_prepare($mysqli, "INSERT INTO luchadores (titulo, subtitulo, categoria, prioridad, fecha,  descripcion, publicacion) VALUES (?, ?, ?, ?, ?, ?, ?)");
            mysqli_stmt_bind_param($stmt, "sssisss", $titulo, $subtitulo, $categoria, $prioridad, $fecha, $descripcion, $publicacion);
        } else {
            $stmt = mysqli_prepare($mysqli, "UPDATE luchadores SET titulo=? , subtitulo=?, categoria=?, prioridad=?, fecha= ?, descripcion = ?, publicacion = ? WHERE luchadores_id = ?");
            mysqli_stmt_bind_param($stmt, "sssisssi", $titulo, $subtitulo,  $categoria, $prioridad, $fecha, $descripcion, $publicacion, $id);
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
            $stmt = mysqli_prepare($mysqli, "INSERT INTO luchadores (titulo, subtitulo, categoria, prioridad, fecha,  descripcion, publicacion, url_imagen) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            mysqli_stmt_bind_param($stmt, "sssissss",$titulo, $subtitulo, $categoria, $prioridad, $fecha, $descripcion, $publicacion, $location);
        } else {
            $stmt = mysqli_prepare($mysqli, "UPDATE luchadores SET  titulo=? , subtitulo=?, categoria=?, prioridad=?, fecha= ?, descripcion = ?, url_imagen = ?, publicacion = ? WHERE luchadores_id = ?");
            mysqli_stmt_bind_param($stmt, "sssissssi",$titulo, $subtitulo, $categoria, $prioridad, $fecha, $descripcion, $location, $publicacion, $id);
        }
    }
    /* execute query */
    mysqli_stmt_execute($stmt);

    $ultimoInsertar=mysqli_stmt_insert_id($stmt);
    if  (!empty($id)){
        $ultimoInsertar = $id;
    }
    
    echo json_encode(['resultado' => 'ok', 'publicacion' => $path_obtener_luchadores.'?id='.$ultimoInsertar]);
}
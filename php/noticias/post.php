<?php

include_once '../config/configbd.php';
include_once '../config/configparameters.php';


mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$titulo =  $_POST['titulo_noticia'];
$subtitulo =  $_POST['subtitulo_noticia'];
$fecha =  $_POST['fecha_noticia'];
$boton =  $_POST['boton_noticia'];
$descripcion =  $_POST['descripcion_noticia'];
$id =  $_POST['id'];

if (empty($fecha)){
    $fecha=date('Y-m-d H:i:s');
}

if (0 < $_FILES['imagen_noticia']['error']) {
    echo 'Error: ' . $_FILES['imagen_noticia']['error'] . '<br>';
} else {
    if (empty($_FILES['imagen_noticia']['name'])) {
        //Subir datos
        if (empty($id)) {
            $stmt = mysqli_prepare($mysqli, "INSERT INTO noticias (titulo, subtitulo, boton, fecha,  descripcion) VALUES (?, ?, ?, ?, ?)");
            mysqli_stmt_bind_param($stmt, "sssss", $titulo, $subtitulo, $boton, $fecha, $descripcion);
        } else {
            $stmt = mysqli_prepare($mysqli, "UPDATE noticias SET titulo=? , subtitulo=?, boton=?, fecha= ?, descripcion = ? WHERE noticia_id = ?");
            mysqli_stmt_bind_param($stmt, "sssssi", $titulo, $subtitulo, $boton, $fecha, $descripcion, $id);
        }
    } else {
        //Subir archivo
        $test = explode('.', $_FILES['imagen_noticia']['name']);
        $extension = end($test);
        $imgtitulo = preg_replace('/[^A-Za-z0-9\-]/', '', $titulo);
        $name = str_replace(' ', '_', $imgtitulo) . rand(100, 999) . '.' . $extension;
        $location = 'upload/' . $name;
        move_uploaded_file($_FILES['imagen_noticia']['tmp_name'], $location);
        $location = $path_noticias . $location;

        //Subir datos
        if (empty($id)) {
            $stmt = mysqli_prepare($mysqli, "INSERT INTO noticias (titulo, subtitulo, boton, fecha,  descripcion, url_imagen) VALUES (?, ?, ?, ?, ?, ?)");
            mysqli_stmt_bind_param($stmt, "ssssss",$titulo, $subtitulo, $boton, $fecha, $descripcion, $location);
        } else {
            $stmt = mysqli_prepare($mysqli, "UPDATE noticias SET  titulo=? , subtitulo=?, boton=?, fecha= ?, descripcion = ?, url_imagen = ? WHERE noticia_id = ?");
            mysqli_stmt_bind_param($stmt, "ssssssi",$titulo, $subtitulo, $boton, $fecha, $descripcion, $location, $id);
        }
    }
    /* execute query */
    mysqli_stmt_execute($stmt);

    $ultimoInsertar=mysqli_stmt_insert_id($stmt);
    if  (!empty($id)){
        $ultimoInsertar = $id;
    }
    
    echo json_encode(['resultado' => 'ok', 'publicacion' => $path_obtener_noticias.'?id='.$ultimoInsertar]);
}
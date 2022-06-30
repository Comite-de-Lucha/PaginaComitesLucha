<?php

include_once '../config/configbd.php';
include_once '../config/configparameters.php';


mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$titulo =  $_POST['titulo_noticia'];
$autor =  $_POST['autor_noticia'];
$fecha =  $_POST['fecha_noticia'];
$categoria =  $_POST['categoria_noticia'];
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
            $stmt = mysqli_prepare($mysqli, "INSERT INTO actualidad (titulo, autor, categoria, fecha,  descripcion) VALUES (?, ?, ?, ?, ?)");
            mysqli_stmt_bind_param($stmt, "sssss", $titulo, $autor, $categoria, $fecha, $descripcion);
        } else {
            $stmt = mysqli_prepare($mysqli, "UPDATE actualidad SET titulo=? , autor=?, categoria=?, fecha= ?, descripcion = ? WHERE actualidad_id = ?");
            mysqli_stmt_bind_param($stmt, "sssssi", $titulo, $autor, $categoria, $fecha, $descripcion, $id);
        }
    } else {
        //Subir archivo
        $test = explode('.', $_FILES['imagen_noticia']['name']);
        $extension = end($test);
        $imgtitulo = preg_replace('/[^A-Za-z0-9\-]/', '', $titulo);
        $name = str_replace(' ', '_', $imgtitulo) . rand(100, 999) . '.' . $extension;
        $location = 'upload/' . $name;
        move_uploaded_file($_FILES['imagen_noticia']['tmp_name'], $location);
        $location = $path_actualidad . $location;

        //Subir datos
        if (empty($id)) {
            $stmt = mysqli_prepare($mysqli, "INSERT INTO actualidad (titulo, autor, categoria, fecha,  descripcion, url_imagen) VALUES (?, ?, ?, ?, ?, ?)");
            mysqli_stmt_bind_param($stmt, "ssssss",$titulo, $autor, $categoria, $fecha, $descripcion, $location);
        } else {
            $stmt = mysqli_prepare($mysqli, "UPDATE actualidad SET  titulo=? , autor=?, categoria=?, fecha= ?, descripcion = ?, url_imagen = ? WHERE actualidad_id = ?");
            mysqli_stmt_bind_param($stmt, "ssssssi",$titulo, $autor, $categoria, $fecha, $descripcion, $location, $id);
        }
    }
    /* execute query */
    mysqli_stmt_execute($stmt);

    echo 'ok';
}
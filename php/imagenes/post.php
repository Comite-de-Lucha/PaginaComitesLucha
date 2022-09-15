<?php

include_once '../config/configparameters.php';

$return_value = "";
if ($_FILES['image']['name']) {
 if (!$_FILES['image']['error']) {
 $name = md5(rand(100, 200));
 $ext = explode('.', $_FILES['image']['name']);
 $filename = $name . '.' . $ext[1];
 $destination = 'upload/' . $filename;
 $location = $_FILES["image"]["tmp_name"];
 move_uploaded_file($location, $destination);
 $return_value = $path_imagenes . $destination;
 }else{
 $return_value = 'No pudimos guardar la imagen, presentó los siguientes problemas: '.$_FILES['image']['error'];
 }
}
echo $return_value;
?>
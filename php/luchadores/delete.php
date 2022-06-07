<?php

include_once '../config/configbd.php';

$id =  $_GET['id'];

if (!empty($id)) {
    $stmt = mysqli_prepare($mysqli, "UPDATE luchadores set activo = false where luchadores_id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);

    /* execute query */
    mysqli_stmt_execute($stmt);

    echo 'ok';
}

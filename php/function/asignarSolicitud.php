<?php

/**
 * Esta Funcion Asigna segun el ID a un Administrador
 * -- toma en cuenta adp de BD --
 * return - ID del Administrador
 * @return void
 */
function asignar(){

    include("conx.php");
    //consulta preparada
    $stmt = mysqli_prepare($connec, "SELECT id_usuario FROM registro WHERE adp = 1");
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    $count = mysqli_stmt_num_rows($stmt);
    $initial = null;
    $arraySet = array();
    mysqli_stmt_bind_result($stmt, $id_usuario);

    while (mysqli_stmt_fetch($stmt)) {
        $arraySet[] = $id_usuario;
    }

    if ($count == 1) {
        $initial = $arraySet[0];
    } else {
        $ad = rand(0, $count - 1);
        $initial = $arraySet[$ad];
        print_r($arraySet);
    }
    return $initial;
}
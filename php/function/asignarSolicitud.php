<?php

/**
 * Esta Funcion Asigna segun el ID a un Administrador
 * _toma en cuenta adp de base de datos_
 * @return mixed ID del Administrador
 */
function asignar()
{
    $conn = new Conexion();
    $sql = $conn->query("SELECT id_usuario FROM registro WHERE adp = 1");

    $arraySet = [];

    while ($resultado = $sql->fetch_object()) {
        $arraySet[] = [$resultado->id_usuario];
    }

    $count = mysqli_num_rows($sql);
    
    if ($count > 1) {
        $ad = rand(0, $count - 1);
        $initial = $arraySet[$ad];
    } else {
        $initial = $arraySet[0];
    }

    $conn->close();
    return $initial;
}
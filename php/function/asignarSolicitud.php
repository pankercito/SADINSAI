<?php

/**
 * Esta Funcion Asigna segun el ID a un Administrador
 * _toma en cuenta adp de base de datos_
 * @return void ID del Administrador
 */
function asignar(){
    $conn = new Conexion();
    $stmt = $conn->query("SELECT id_usuario FROM registro WHERE adp = 1");

    $arraySet = array();

    while ($resultado = $stmt->fetch_array()) {
        $arraySet = $arraySet + $resultado;
    }

    $count = count($arraySet);
    $initial = null;

    if ($count == 1) {
        $initial = $arraySet[0];
    } else {
        $ad = rand(0, $count - 1);
        $initial = $arraySet[$ad];
    }

    return $initial;
}

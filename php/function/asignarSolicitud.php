<?php

/**
 * Esta Funcion Asigna segun el ID a un Administrador
 * _toma en cuenta adp de base de datos_
 * @return mixed ID del Administrador
 */
function asignar()
{
    $conn = new Conexion();
    $stmt = $conn->query("SELECT * FROM registro WHERE adp = 1");

    $arraySet = array();

    while ($resultado = $stmt->fetch_array()) {
        $arraySet = $arraySet + $resultado;
    }

    $count = mysqli_num_rows($stmt);
    $initial = [];

    if ($count != 1) {
        $ad = rand(0, $count - 1);
        $initial = $arraySet[$ad];
    } else {
        $initial = $arraySet[0];
    }
    $conn->close();

    return $initial;
}
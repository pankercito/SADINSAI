<?php

/**
 * Iniciar sesion en la base de datos
 * @param string $user ID de usuario
 * @return
 */
function initSesion($user){
    $conn = new Conexion;
    $ssn = $conn->query("UPDATE registro SET sesion = '1' WHERE registro.id_usuario = $user");
    if ($ssn){
        return true;
    } else{
        return false;
    }
}

/**
 * Cerrar sesion en la base de datos
 * @param string $user ID de usuario
 * @return
 */
function outSesion($user){
    $conn = new Conexion;
    $ssn = $conn->query("UPDATE registro SET sesion = '0' WHERE registro.id_usuario = $user");
    if ($ssn){
        return true;
    } else{
        return false;
    }
}
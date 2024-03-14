<?php

session_start();

include "../php/configIncludes.php";

// Establecer la duración de la sesión en inix
$duracion_sesion = 289;

// Comprobar si el usuario está autenticado y la sesión está activa
if (isset($_SESSION['LAST_ACTIVITY'])) {
    // Calcular el tiempo transcurrido desde la última actividad
    $tiempo_transcurrido = time() - $_SESSION['LAST_ACTIVITY'];

    // Si ha pasado el tiempo de duración de la sesión, cerrar la sesión
    if ($tiempo_transcurrido > $duracion_sesion) {
        echo 'expirado';
    } else {
        echo 'activo';
    }
} else {
    echo 'expirado';
}
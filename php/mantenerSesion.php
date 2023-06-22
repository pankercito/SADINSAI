<?php

// PHP para mantener la sesión activa (actualizar la última actividad)
session_start();

// Establecer la duración de la sesión en segundos
$duracion_sesion = 600;

// Comprobar si el usuario está autenticado y la sesión está activa
if (isset($_SESSION['LAST_ACTIVITY'])) {
    // Calcular el tiempo transcurrido desde la última actividad
    $tiempo_transcurrido = time() - $_SESSION['LAST_ACTIVITY'];

    // Si ha pasado el tiempo de duración de la sesión, cerrar la sesión
    if ($tiempo_transcurrido > $duracion_sesion) {
        session_unset();
        session_destroy();
        header('Location: cerrarSesion.php');
    } else {
        // Actualizar la última actividad de la sesión
        $_SESSION['LAST_ACTIVITY'] = time();
    }
} else {
    header('Location: cerrarSesion.php');
}
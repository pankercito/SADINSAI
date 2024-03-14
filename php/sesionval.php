<?php

session_start();

date_default_timezone_set('America/Caracas');

include "../php/configIncludes.php";

// Controlo si el usuario ya está logueado en el sistema.
if (isset($_SESSION['sesioninit'])) {
    // Guardar datos de sesioninit es en variables
    $wname = $_SESSION['userdata'];
    $wci = encriptar($_SESSION['cidelusuario']);
    $adpval = $_SESSION['admincheck'];

    include "../php/actualizarSesion.php";
} else {
    // Si no está logueado lo redireccion a la página de login.
    header("HTTP/1.1 302 Moved Temporarily");
    header("location: ../php/cerrarSesion.php");
}
<?php
ini_set('session.cookie_lifetime', 600); //tiempo de la sesion en segundos

include("function/criptCodes.php");
include("function/dec.php");
include("actualizarSesion.php");

// Controlo si el usuario ya está logueado en el sistema.
if(isset($_SESSION['sesioninit']))
{
    // Guardar datos de sesioninit es en variables
    $wname = $_SESSION['userdata'];
    $wci = encriptar($_SESSION['cidelusuario']);
    $adpval= $_SESSION['admincheck'];
}
else{
    // Si no está logueado lo redireccion a la página de login.
    header("HTTP/1.1 302 Moved Temporarily");
    header("location: ../php/cerrarSesion.php");

}


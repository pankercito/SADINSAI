<?php 

session_start();

// Controlo si el usuario ya está logueado en el sistema.
if(isset($_SESSION['sesioninit']))
{
    // Guardar datos de sesioninites en variables
    $wname = $_SESSION['sesioninit'];
    $wci = $_SESSION['cidelusuario'];
    $adpval= $_SESSION['admincheck'];
}
else
{
    // Si no está logueado lo redireccion a la página de login.
    header("HTTP/1.1 302 Moved Temporarily");
    header("location:../sadinsai/index.php");

}


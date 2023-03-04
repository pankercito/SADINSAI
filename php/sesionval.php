<?php 

session_start();

// Controlo si el usuario ya está logueado en el sistema.
if(isset($_SESSION['nombredelusuario']))
{
<<<<<<< HEAD
    // Guardar datos de sesiones en variables
=======
    // Le doy la bienvenida al usuario.
>>>>>>> ef454668b094ed648e94e17d925e51a7f585f6bd
    $wname = $_SESSION['nombredelusuario'];
    $wlastname = $_SESSION['apellidodelusuario'];
    $wci = $_SESSION['cidelusuario'];
    $adpval= $_SESSION['admincheck'];
}
else
{
    // Si no está logueado lo redireccion a la página de login.
    header("HTTP/1.1 302 Moved Temporarily");
    header("location:../sadinsai/index.php");

}


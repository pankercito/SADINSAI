<?php 

session_start();

// Controlo si el usuario ya está logueado en el sistema.
if(isset($_SESSION['nombredelusuario']))
{
    // Le doy la bienvenida al usuario.
    $usuarioingresado = $_SESSION['nombredelusuario'];
}
else
{
    // Si no está logueado lo redireccion a la página de login.
    header("HTTP/1.1 302 Moved Temporarily");
    header("location:../sadinsai/index.php");

}


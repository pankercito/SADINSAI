<?php

session_start();

if(isset($_SESSION['sesion'])){
    include("funtion/sesion.php");
    include("conect.php");

    $cerrar = outSesion($_SESSION['sesion']);

    if(isset($_SESSION['event'])){
        $evento  = $_SESSION['event'];
        echo $evento;
        $delevent = "DROP EVENT IF EXISTS $evento";
        
        $sql = mysqli_query($connec, $delevent);
        $connec->close();
    }
}
session_destroy();
session_unset();

header("Location: ../index.php"); // redirige al usuario a la página de inicio de sesión

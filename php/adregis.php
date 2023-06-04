<?php

include("adp.php");

if (isset($_POST["user"]) || ($_POST["pass"]) || ($_POST["checkadmin"])){
    
    require ("conect.php");

    $cedula = mysqli_real_escape_string($connec, $_SESSION['subcedula']);
    $usuario = mysqli_real_escape_string($connec,strtoupper($_POST['user']));
    $contrasena = mysqli_real_escape_string($connec, $_POST['pass']);
    $admincheck = ($_POST['checkadmin']) ?? null;
    
    $admincheck = $admincheck + 0;
    
    $proceso = mysqli_query($connec, "INSERT INTO registro (ci, user, pass, adp) VALUES ('$cedula ', '$usuario', '$contrasena', '$admincheck')");
    
    if (!$proceso) { //verificacion de registro exitosa en la base de datos
        
        echo "no se pudo registrar por favor intenta de nuevo <a href='?adminregister=true'>click para registrar de nuevo</a>";
    
    } else {
        unset($_SESSION['subcedula']);
        echo "registro finalizo correctamente <a href='?users/register=true'>click para registrar de nuevo</a>";
    }
} else {
    echo "no se pudo registrar por favor intenta de nuevo <a href='?adminregister=true'>click para registrar de nuevo</a>";
}
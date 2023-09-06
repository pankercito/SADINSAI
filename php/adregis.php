<?php

include("adp.php");

if (isset($_POST["user"]) || ($_POST["pass"]) || ($_POST["checkadmin"])){

    $cedula = $conn->real_escape($_SESSION['subcedula']);
    $usuario =  $conn->real_escape(strtoupper($_POST['user']));
    $contrasena = encriptar( $conn->real_escape( $_POST['pass']));
    $admincheck = ($_POST['checkadmin']) ?? null;
    
    $admincheck = $admincheck + 0;
    
    $proceso = $conn->query("INSERT INTO registro (ci, user, pass, adp) VALUES ('$cedula ', '$usuario', '$contrasena', '$admincheck')");

    unset($_SESSION['subcedula']);
    unset($_SESSION['recoveryCi']);

    if(!$proceso){ //verificacion de registro exitosa en la base de datos
        echo "no se pudo registrar por favor intenta de nuevo <a href='?adminregister=true'>click para registrar de nuevo</a>";    
    }else 
        echo "registro finalizo correctamente <a href='?users/register=true'>click para registrar de nuevo</a>";
}else{
    unset($_SESSION['subcedula']);
    unset($_SESSION['recoveryCi']);
    echo "no se pudo registrar por favor intenta de nuevo <a href='?adminregister=true'>click para registrar de nuevo</a>";
}
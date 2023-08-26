<?php

include("adp.php");

if (isset($_POST["user"]) || ($_POST["pass"]) || ($_POST["checkadmin"])){

    $cedula = mysqli_real_escape_string($conn, $_SESSION['subcedula']);
    $usuario = mysqli_real_escape_string($conn,strtoupper($_POST['user']));
    $contrasena = encriptar(mysqli_real_escape_string($conn, $_POST['pass']));
    $admincheck = ($_POST['checkadmin']) ?? null;
    
    $admincheck = $admincheck + 0;
    
    $proceso = $conn->query("INSERT INTO registro (ci, user, pass, adp) VALUES ('$cedula ', '$usuario', '$contrasena', '$admincheck')");

    unset($_SESSION['subcedula']);

    if(!$proceso){ //verificacion de registro exitosa en la base de datos
        echo "no se pudo registrar por favor intenta de nuevo <a href='?adminregister=true'>click para registrar de nuevo</a>";    
    }else 
        echo "registro finalizo correctamente <a href='?users/register=true'>click para registrar de nuevo</a>";
}else{
    unset($_SESSION['subcedula']);
    echo "no se pudo registrar por favor intenta de nuevo <a href='?adminregister=true'>click para registrar de nuevo</a>";
}
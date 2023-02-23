<?php

if (isset($_POST["user"]) || ($_POST["pass"]) || ($_POST["checkadmin"])){
    
    require ("conect.php");

    $cedula = $_SESSION['subcedula'];
    $usuario = ($_POST['user']);
    $contrasena = ($_POST['pass']);
    $admincheck = ($_POST['checkadmin']) ?? null;
    
    $admincheck = $admincheck + 0;
    
    $proceso = mysqli_query($connec, "INSERT INTO registro (ci, user, pass, adp) VALUES ('$cedula ', '$usuario', '$contrasena', '$admincheck')");
    
    if (!$proceso) { //verificacion de registro exitosa en la base de datos
        
        echo "no se pudo registrar por favor intenta de nuevo <a href='?adminregister=true'>click para registrar de nuevo</a>";
    
    } else {
        unset($_SESSION['subcedula']);
        echo "registro finalizo correctamente <a href='?perfil=true'>click para registrar de nuevo</a>";
    }
} else {
    echo "no se pudo registrar por favor intenta de nuevo <a href='?adminregister=true'>click para registrar de nuevo</a>";
}
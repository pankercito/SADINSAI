<?php

if (isset($_POST['cedula']) || ($_POST['name']) || ($_POST['user']) || ($_POST['checkadmin'])){
    include_once ("conect.php");

    $subs_cedula = ($_POST['cedula']);
    $subs_name = ($_POST['name']);
    $subs_user = ($_POST['user']);
    $subs_pass = ($_POST['pass']);
    $admincheck = ($_POST['checkadmin']);
    
    $admincheck = $admincheck + 0;
    
    $proceso = mysqli_query($connec, "INSERT INTO registro (ci, nombre, user, pass, adp) VALUES ('$subs_cedula ', '$subs_name', '$subs_user', '$subs_pass', '$admincheck')");
    
    
    if (!$proceso) { //verificacion de conexion exitosa en la base de datos
        
        echo "no se pudo registrar por favor intenta de nuevo <a href='php/registro.php'>click para registrar de nuevo</a>";
    
    } else {
        echo "registro finalizo correctamente <a href='?perfil=true'>click para registrar de nuevo</a>";
    }
}






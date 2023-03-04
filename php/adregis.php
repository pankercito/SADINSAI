<?php

<<<<<<< HEAD
if (isset($_POST["user"])){
    
    require ("conect.php");
    
    $usuario = mysqli_real_escape_string($connec, trim($_POST['user']));
    
    $stmt = mysqli_query($connec, "SELECT user FROM registro WHERE user='$usuario'");
    
    $checkuser = mysqli_num_rows($stmt);

    if ($checkuser == 1) {
    
        header('location: ?users/register-two=true&erroruser=true');
        
    }else{

        $cedula = mysqli_real_escape_string($connec, trim($_SESSION['subcedula']));
        $contrasena = mysqli_real_escape_string($connec, trim($_POST['pass']));
        $admincheck = ($_POST['checkadmin']) ?? null;
    
        $admincheck = $admincheck + 0;

        $proceso = mysqli_query($connec, "INSERT INTO registro (ci, user, pass, adp) VALUES ('$cedula ', '$usuario', '$contrasena', '$admincheck')");
    
        if (!$proceso) { //verificacion de registro exitosa en la base de datos
        echo "no se pudo registrar por favor intenta de nuevo <a href='?users/register=true'>click para registrar de nuevo</a>";
    
        } else {
        unset($_SESSION['subcedula']);
        echo "registro finalizo correctamente <a href='?perfil=true'>click para registrar de nuevo</a>";
        }
    }

} else {
    echo "No se ha podido registrar por favor intenta de nuevo <a href='?users/register=true'>click para registrar de nuevo</a>";
=======
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
>>>>>>> ef454668b094ed648e94e17d925e51a7f585f6bd
}
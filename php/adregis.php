<?php

include "adp.php";
include "../php/configIncludes.php";

$gestionDeUsuario = new UserAuditoria();

if (isset($_SESSION['subcedula'])) {
    if (isset($_POST["user"]) && ($_POST["pass"]) && ($_POST["pin"])) {

        $cedula = $conn->real_escape($_SESSION['subcedula']);
        $usuario = $conn->real_escape(strtoupper($_POST['user']));
        $contrasena = encriptar($conn->real_escape($_POST['pass']));
        $pin = $conn->real_escape($_POST['pin']);
        $admincheck = ($_POST['checkadmin']) ?? null;

        $admincheck = $admincheck + 0;

        if ($gestionDeUsuario->registroDeUsuario()) {
            $proceso = $conn->query("INSERT INTO registro (ci, user, pass, pin, adp) VALUES ('$cedula ', '$usuario', '$contrasena', '$pin', '$admincheck')");

            unset($_SESSION['subcedula']);

            if (!$proceso) { //verificacion de registro exitosa en la base de datos
                echo "no se pudo registrar por favor intenta de nuevo <a href='?adminregister=true'>click para registrar de nuevo</a>";
            } else {
                echo "registro finalizo correctamente";
            }
        }
    } else {
        unset($_SESSION['subcedula']);
        echo "no se pudo registrar por favor intenta de nuevo <a href='?adminregister=true'>click para registrar de nuevo</a>";
    }
} else {
    echo "<h6> elija una opcion </h6>";
}
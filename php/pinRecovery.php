<?php

include "../php/configIncludes.php";

session_start();

$conn = new Conexion;

if ($_POST["pin"] != "" && $_POST["ci"] != "") {

    $user = new User(getUserHash(null, $conn->real_escape($_POST["ci"])));

    // Verificación de pin ingresada en la base de datos
    $pin = $conn->real_escape($_POST["pin"]);

    if ($user->getPin() == $pin) {
        echo "pin.success";
    } else {
        echo "pin.error";
    }

} else {
    echo "false"; //vacio
}
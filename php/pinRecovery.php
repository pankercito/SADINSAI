<?php

include('conx.php');

session_start();

$conn = new Conexion;

if ($_POST["pin"] != "" && $_POST["ci"] != "" ) {

    // Verificación de pin ingresada en la base de datos
    $pin = $conn->real_escape($_POST["pin"]);

    $cei = $conn->real_escape($_POST["ci"]);

    $sql = "SELECT * FROM registro WHERE pin = $pin and ci = $cei ";
    $result = $conn->query($sql);
    $conn->close();

    if ($result->num_rows == 1) {
        echo "pin.success"; //correcto
    } else {
        echo "pin.error"; //no correcto
    }
} else {
    echo "false"; //vacio
}
<?php

include('conx.php');

session_start();

$conn = new Conexion;

if ($_POST["pin"] != "" && isset($_SESSION["sesion"])) {

    // Verificación de pin ingresada en la base de datos
    $com = $conn->real_escape($_POST["pin"]);

    $cel = $_SESSION["sesion"];

    $sql = "SELECT * FROM registro WHERE pin = $com and id_usuario = $cel ";
    $result = $conn->query($sql);
    $conn->close();

    if ($result->num_rows > 0) {
        echo "pin.success"; //correcto
    } else {
        echo "pin.error"; //no correcto
    }
} else {
    echo "false"; //vacio
}
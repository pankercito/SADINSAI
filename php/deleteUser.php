<?php
include("conx.php");


$conn = new Conexion();

$user = $conn->real_escape($_POST['userId']);


$sql = $conn->query("DELETE FROM registro WHERE id_usuario = '$user'");
if ($sql == true) {
    echo "success.dele";
} else {
    echo "error.dele";
}

$conn->close();
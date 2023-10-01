<?php
include("conx.php");


$conn = new Conexion();

$user = $conn->real_escape($_POST['userId']);

$conn->query("SET @autoid := 0");
$conn->query("UPDATE registro SET id_usurio = (@autoid := @autoid + 1)");
$conn->query("ALTER TABLE registrp AUTO_INCREMENT = 1");

$sql = $conn->query("DELETE FROM registro WHERE id_usuario = '$user'");
if ($sql == true) {
    echo "success.dele";
} else {
    echo "error.dele";
}

$conn->close();
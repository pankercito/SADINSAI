<?php
include("conexion-barbara.php");

$id = $_post['id'];
$nombre = $_post['nombre'];
$apellido = $_post['apellido'];
$id_estado = $_post['id_estado'];
$id_sede = $_post['id_sede'];
$ubicacion = $_post['ubicacion'];
$telefono = $_post['telefono'];

$actualizar = "UPDATE perfiles SET nombre='$nombre', apellido='$apellido', id_estado='$id_estado', id_sede='$id_sede', ubicaion='$ubicacion', telefono='$telefono' WHERE id_ci='$id'";
$resultado = mysqli_query($conexion, $actualizar);
?>
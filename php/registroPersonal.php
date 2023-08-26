<?php

include("conx.php");

include("function/removerAcentos.php");

$conn = new Conexion();

$cedula = $_POST['ci'];
$taken=  strtoupper(remover_acentos($_POST['name']));
$apellido=  strtoupper(remover_acentos($_POST['apellido']));
$email =  strtoupper(remover_acentos($_POST['email']));
$direccion =  strtoupper(remover_acentos($_POST['direccion']));
$phone = $_POST['telefono'];
$estado = $_POST['estado'];
$ciudad = $_POST['ciudad'];
$sede = $_POST['sede'];

$correr = "INSERT INTO personal (ci, nombre, apellido, id_estado, id_ciudad, sede_id, direccion, email, telefono) 
    VALUES ('$cedula','$taken','$apellido', '$estado', '$ciudad', '$sede', '$direccion', '$email', '$phone')";

$proceso=  $conn->query( $correr);

if (!$proceso) { //verificacion de conexion exitosa en la base de datos
    header('location: ../public/anadir.php?error=true'); 
} else {
    header('location: ../public/anadir.php?exito=true');   
}
<?php

include "conect.php";

$cedula = mysqli_real_escape_string($connec,$_POST['ci']);
$name=  mysqli_real_escape_string($connec, strtoupper($_POST['name']));
$apellido= mysqli_real_escape_string($connec, strtoupper($_POST['apellido']));
$email = mysqli_real_escape_string($connec, strtoupper($_POST['email']));
$direccion = mysqli_real_escape_string($connec, strtoupper($_POST['direccion']));
$phone = mysqli_real_escape_string($connec,strtoupper($_POST['telefono']));
$estado = $_POST['estado'];
$ciudad = $_POST['ciudad'];
$sede = $_POST['sede'];

$correr = "INSERT INTO personal (ci, nombre, apellido, id_estado, id_ciudad, sede_id, direccion, email, telefono) 
    VALUES ('$cedula','$name','$apellido', '$estado', '$ciudad', '$sede', '$direccion', '$email', '$phone')";

$proceso= mysqli_query($connec, $correr);

if (!$proceso) { //verificacion de conexion exitosa en la base de datos
    header('location: ../public/anadir.php?error=true'); 
} else {
    header('location: ../public/anadir.php?exito=true');   
}
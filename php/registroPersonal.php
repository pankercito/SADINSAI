<?php

include("conx.php");

include("function/removerAcentos.php");

$conn = new Conexion();

$cedula = $conn->real_escape($_POST['ci']);
$nombre =  strtoupper(remover_acentos($_POST['name']));
$apellido =  strtoupper(remover_acentos($_POST['apellido']));
$sexo = $conn->real_escape($_POST['sexo']);
$nac = $conn->real_escape($_POST['edad']);
$grado = $conn->real_escape($_POST['grado_academico']);
$email =  strtoupper(remover_acentos($_POST['email']));
$direccion =  strtoupper(remover_acentos($_POST['direccion']));
$phone = $conn->real_escape($_POST['telefono']);
$estado = $conn->real_escape($_POST['estado']);
$ciudad = $conn->real_escape($_POST['ciudad']);
$sede = $conn->real_escape($_POST['sede']);

$correr = "INSERT INTO `personal` (`ci`, `nombre`, `apellido`, `grado_ac`, `fecha_nac`, `sexo`, `id_estado`, `id_ciudad`, `sede_id`, `direccion`, `email`, `telefono`, `cargo`) 
                        VALUES ('$cedula', '$nombre ', '$apellido', '$sexo', '$nac', '$grado', '$estado', '$ciudad', '$sede', '$direccion', '$emai ', '$phone', '')";

$proceso=  $conn->query( $correr);

if (!$proceso) { //verificacion de conexion exitosa en la base de datos
    header('location: ../public/anadir.php?error=true'); 
} else {
    header('location: ../public/anadir.php?exito=true');   
}
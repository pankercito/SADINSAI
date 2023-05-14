<?php

include "conect.php";

$cedula = mysqli_real_escape_string($connec, strtoupper($_POST['ci']));
$name=  strtoupper($_POST['name']);
$apellido= strtoupper($_POST['apellido']);
$estado = strtoupper($_POST['estado']);
$ciudad = strtoupper($_POST['ciudad']);
$ubicacion = strtoupper($_POST['direccion']);
$phone = strtoupper($_POST['telefono']);


$correr = "INSERT INTO personal (ci, nombre, apellido, id_estado, id_ciudad, direccion, telefono) VALUES ('$cedula','$name','$apellido', '$estado', '$ciudad', '$ubicacion','$phone')";

$proceso= mysqli_query($connec, $correr);

if (!$proceso) { //verificacion de conexion exitosa en la base de datos
        
    echo "no se pudo registrar por favor intenta de nuevo <a href='?adminregister=true'>click para registrar de nuevo</a>";

} else {
    echo "registro finalizo correctamente <a href='../formulario.html'>click para registrar de nuevo</a>";
}
?>
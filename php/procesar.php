<?php

include "conect.php";

$cedula = ($_POST['ci']);
$name=  ($_POST['name']);
$apellido= ($_POST['apellido']);
$ubicacion = ($_POST['ubicacion']);
$sexo = ($_POST['telefono']);


$correr = "INSERT INTO perfiles (ci, nombre, apellido, ubicacion, telefono) VALUES ('$cedula','$name','$apellido','$ubicacion','$sexo')";

$proceso= mysqli_query($connec, $correr);

if (!$proceso) { //verificacion de conexion exitosa en la base de datos
        
    echo "no se pudo registrar por favor intenta de nuevo <a href='?adminregister=true'>click para registrar de nuevo</a>";

} else {
    echo "registro finalizo correctamente <a href='../formulario.html'>click para registrar de nuevo</a>";
}
?>
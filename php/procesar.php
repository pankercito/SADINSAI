<?php

include "/conect.php";

$cedula = utf8_decode ($_POST['ci']);
$level = utf8_decode ( $_POST['level']);
$sede = utf8_decode  ($_POST['sede']);
$estado = utf8_decode  ($_POST['estado']);
$ubicacion = utf8_decode  ($_POST['gps']);
$sexo = utf8_decode  ($_POST['sexo']);
$name= utf8_decode  ($_POST['name']);

$correr = "INSERT INTO base (ci, nivel, sede, estado, ubicacion, sexo, nombreyapellido) VALUES ('$cedula', '$level', '$sede', '$estado','$ubicacion','$sexo','$name')";

mysqli_query($connec, $correr);

?>
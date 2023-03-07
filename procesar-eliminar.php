<?php
include("conexion-barbara.php");

$id = $_get['id'];
$eliminar = "DELENTE FROM perfiles WHERE id_ci = 'id'";
$resultadoeliminar = mysqli_query($conexion, $eliminar);
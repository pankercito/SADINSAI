<?php

include('../php/conx.php');

$conn = new Conexion();

// Preparar la consulta para obtener las ciudades correspondientes al estado seleccionado
$sql = "SELECT * FROM ciudades";

// Ejecutar la consulta
$resultado = $conn->query($sql);

while($row = mysqli_fetch_array($resultado)){
    echo '<option value="'.$row['id_ciudad'].'">'.$row['ciudad'].'</option>';
}
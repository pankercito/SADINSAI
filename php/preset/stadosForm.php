<?php

if (!class_exists('Conexion')) {
    include "conx.php";
}
$conn = new Conexion();

// Preparar la consulta para obtener las ciudades correspondientes al estado seleccionado
$sql = "SELECT * FROM estados";

// Ejecutar la consulta
$resultado = $conn->query($sql);

while ($row = $resultado->fetch_assoc()) {
    echo '<option value="' . $row['id_estado'] . '">' . $row['estado'] . '</option>';
}
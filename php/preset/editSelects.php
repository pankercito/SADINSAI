<?php

include "../php/class/conx.php";

$conn = new Conexion();

// Preparar la consulta para obtener las ciudades correspondientes al estado seleccionado
$sql = "SELECT * FROM sedes";

// Ejecutar la consulta
$resultado = $conn->query($sql);

while ($row = mysqli_fetch_array($resultado)) {
    echo '<option value="' . $row['sede_id'] . '">' . $row['nombre_sede'] . '</option>';
}
<?php

include "../class/conx.php";

$conn = new Conexion();

// Obtener el estado seleccionado desde el formulario de javascrytp
$estadoSeleccionado = $_POST['estado'];

// Preparar la consulta para obtener las ciudades correspondientes al estado seleccionado
$sql = "SELECT * FROM sedes WHERE id_estado_sed = '$estadoSeleccionado'";

// Ejecutar la consulta
$resultado = $conn->query($sql);

while ($row = mysqli_fetch_array($resultado)) {
    echo '<option value="' . $row['sede_id'] . '">' . $row['nombre_sede'] . '</option>';
}
<?php

include('../conect.php');

// Obtener el estado seleccionado desde el formulario de javascrytp
$estadoSeleccionado = $_POST['estado'];

// Preparar la consulta para obtener las ciudades correspondientes al estado seleccionado
$sql = "SELECT * FROM sedes WHERE id_estado = '$estadoSeleccionado'";

// Ejecutar la consulta
$resultado = mysqli_query($connec, $sql);

while($row = mysqli_fetch_array($resultado)){
    echo '<option value="'.$row['sede_id'].'">'.$row['nombre_sede'].'</option>';
}
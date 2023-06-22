<?php

include('../php/conect.php');

// Preparar la consulta para obtener las ciudades correspondientes al estado seleccionado
$sql = "SELECT * FROM sedes LIMIT 500;";

// Ejecutar la consulta
$resultado = mysqli_query($connec, $sql);

while($row = mysqli_fetch_array($resultado)){
    echo '<option value="'.$row['sede_id'].'">'.$row['nombre_sede'].'</option>';
}
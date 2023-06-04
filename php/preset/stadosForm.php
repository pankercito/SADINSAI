<?php

include('../conect.php');

// Preparar la consulta para obtener las ciudades correspondientes al estado seleccionado
$sql = "SELECT * FROM estados";

// Ejecutar la consulta
$resultado = mysqli_query($connec, $sql);

while($row = mysqli_fetch_array($resultado)){
    echo '<option value="'.$row['id_estado'].'">'.$row['estado'].'</option>';
}
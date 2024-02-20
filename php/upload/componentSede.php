<?php

include "../class/conx.php";

$conn = new Conexion();

$cargo = strtoupper($conn->real_escape(trim($_POST["sede"])));
$estado = $conn->real_escape(trim($_POST["estado"]));
$dir = strtoupper($conn->real_escape(trim($_POST["direccion"])));

$verfy = $conn->query("SELECT * FROM sedes");
$total = $verfy->num_rows + 1;
$verfy = $conn->query("SELECT * FROM sedes WHERE nombre_sede = '$cargo' AND id_estado_sed = $estado");

$vacie = $verfy->num_rows;
if ($vacie == 0) {
    $vrfy = $conn->query("INSERT INTO sedes (sede_id, id_estado_sed, nombre_sede, dir_local) VALUES ('$total', '$estado', '$cargo', '$dir')");
    if ($vrfy == true) {
        echo "success";
    } else {
        echo "query.error" . $total . $conn->error();
    }
} else {
    echo "dupli";
}
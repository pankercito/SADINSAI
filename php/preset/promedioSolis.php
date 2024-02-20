<?php

include "../../php/class/classIncludes.php";
include "../../php/function/sumarhora.php";

$conn = new Conexion();

// SACAR DATOS DE SOLICITUDES
$colis = $conn->query("SELECT * FROM solicitudes_y_permisos WHERE estado_permiso NOT IN (1)");
$colis1 = $conn->query("SELECT * FROM solicitudes_y_permisos WHERE estado_permiso = 2");
$colis2 = $conn->query("SELECT * FROM solicitudes_y_permisos WHERE estado_permiso = 3");
$colis3 = $conn->query("SELECT * FROM solicitudes_y_permisos WHERE estado_permiso = 4");

$total = $colis->num_rows;

$aceptadas = $colis1->num_rows;
$rechazadas = $colis2->num_rows;
$anulas = $colis3->num_rows;

$aceptadas = number_format($aceptadas / $total * 100, 2);
$rechazadas = number_format($rechazadas / $total * 100, 2);
$anulas = number_format($anulas / $total * 100, 2);


// enviamos los datos como caden json
echo json_encode([$aceptadas, $rechazadas, $anulas, $total]);
<?php

include('conx.php');

$conn = new Conexion;

$cororo = $conn->query("SELECT * FROM solicitudes WHERE apr_estado = 0");
$cororo1 = $conn->query("SELECT * FROM solicitudes_y_permisos WHERE estado_permiso = 1");

if ($cororo->num_rows > 0 || $cororo1->num_rows > 0) {
    $verifySolicitudes = true;
} else {
    $verifySolicitudes = false;
    exit();
}

$totalSolicitudes = ($cororo->num_rows > 0) ? $cororo->num_rows : 0;
$totalSolicitudes1 = ($cororo1->num_rows > 0) ? $cororo1->num_rows : 0;

$array['carmen'] = [
    'veri' => $verifySolicitudes,
    'totalGestion' => $totalSolicitudes,
    'totalSolis' => $totalSolicitudes1
];

echo json_encode($array);
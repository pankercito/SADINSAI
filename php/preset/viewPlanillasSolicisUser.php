<?php

include '../class/classIncludes.php';
include "../function/criptCodes.php";

session_start();

$yo = $_SESSION['cidelusuario'];

$a = Solicitud::obtenerSolicitud();

$coro = $a->allSolicitudes();

$apr = [
    "1" => "alert alert-secondary",
    "2" => "alert alert-success",
    "3" => "alert alert-danger",
    "4" => "alert alert-primary",
];
$aprN = [
    "1" => "pendiente",
    "2" => "aceptada",
    "3" => "rechazada",
    "4" => "anulada",
];
$aprL = [
    "1" => 'bi bi-person-lines-fill',
    "2" => 'bi bi-person-fill-check',
    "3" => 'bi bi-person-fill-x',
    "4" => 'bi bi-person-fill-x'
];

$tipoSolic = [
    "1" => "anticipo",
    "2" => "permiso",
    "3" => "vacaciones",
    "4" => "carta de aval",
    "5" => "paternidad"
];

if (!@$coro['Error']) {
    $data[] = [
        '',
        '',
        '',
        'no haz realizado acciones',
        '',
        '',
        '',
    ];

    $verg['data'] = $data;

    echo json_encode($verg);
    exit;
}

foreach ($coro as $key) {

    $data[] = [
        $key['id_solicitud_permiso'],
        $tipoSolic[$key['tipo_permiso']],
        $key['ci_permiso'],
        $key['fecha_permiso'],
        ' <a onclick="detallesPlanillas(' . $key['id_solicitud_permiso'] . ', ' . $key['tipo_permiso'] . ')" class="btn btn-success">ver detalles</a> ',
        '<a class="aprState ' . $apr[$key['estado_permiso']] . '" disabled>' . $aprN[$key['estado_permiso']] . '<span style="margin:.5rem;"></span><i class="' . $aprL[$key['estado_permiso']] . '"></i></a>',
        $key['estado_permiso'],
    ];
}

$verg['data'] = $data;

echo json_encode($verg);
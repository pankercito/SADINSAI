<?php

include "../preset/presetConfigIncludes.php";

$n = new Estadistica;
$p = $n->promedioAceptacionSolicitudes();

$aceptadas = $p['aceptadas'];
$rechazadas = $p['rechazadas'];
$anulas = $p['anuladas'];

$total = $p['total'];


// enviamos los datos como caden json
echo json_encode([$aceptadas, $rechazadas, $anulas, $total]);
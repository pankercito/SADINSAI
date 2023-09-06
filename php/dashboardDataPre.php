<?php

include("../php/conx.php");
include("../php/class/auditoria.php");
include("../php/function/sumarhora.php");

$new = new auditoria();

$dat = rangoFechas(); //rango de fechas semanal automatico

// definimos array de datos 
$json = $new->userStats($dat['lunes'], $dat['domingo']);
$jsa = $new->solicitudStats($dat['lunes'], $dat['domingo']);
$jsc = $new->archivesStats($dat['lunes'], $dat['domingo']);

// enviamos los datos como caden json
echo json_encode([$json, $jsa, $jsc]);
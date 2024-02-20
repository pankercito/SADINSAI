<?php

include "../php/class/classIncludes.php";
include "../php/function/sumarhora.php";

$estadistica = new Estadistica();

// definimos array de datos 
$json = $estadistica->gestionDetailstStats(date('Y-m-d'));

// enviamos los datos como caden json
echo json_encode($json);
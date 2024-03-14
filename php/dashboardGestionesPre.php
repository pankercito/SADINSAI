<?php

include "../php/configIncludes.php";

$estadistica = new Estadistica();

// definimos array de datos 
$json = $estadistica->gestionDetailsStats(date('Y-m-d'));

// enviamos los datos como caden json
echo json_encode($json);
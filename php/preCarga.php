<?php

include_once("../php/editSet.php");

$datos = array(
    'opcionE' => $SetIdEstado,
    'opcionC' => $SetIdCiudad,
    'opcionS' => $SetIdSede
);

echo json_encode($datos);
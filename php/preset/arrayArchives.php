<?php

// Array de datos para CARD SELECTOR

$direcciones = [];
 
for($i = 1001; $i < 1047; $i++ ){
    $opcion = $i;
    $valor = "../layout/cardOnly.php";
    $direcciones[$opcion] = $valor;
}

$direcciones['1046'] = "../layout/planillas.php";
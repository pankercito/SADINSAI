<?php

$direcciones = array();
 
for($i = 1001; $i < 1047; $i++ ){
    $opcion = $i;
    $valor = "../layout/cards.php";
    $direcciones[$opcion] = $valor;
}

$direcciones['1046'] = "../layout/planillas.php";
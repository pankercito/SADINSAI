<?php

$direcciones = array();
 
for($i = 1001; $i != 1047; $i++ ){
    $opcion = $i;
    $valor = "../layout/cards.php";
    $direcciones[$opcion] = $valor;
}

$direcciones["1002"] = "../layout/cardOnly.php";
$direcciones["1003"] = "../layout/cardOnly.php";
$direcciones["1004"] = "../layout/cardOnly.php";
$direcciones["1005"] = "../layout/cardOnly.php";

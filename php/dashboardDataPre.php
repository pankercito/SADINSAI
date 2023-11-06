<?php

include("../php/conx.php");
include("../php/class/auditoria.php");
include("../php/function/sumarhora.php");

$new = new Auditoria();

$dat = rangoFechas(); //rango de fechas semanal automatico

function total($array)
{
    $o = 0;
    foreach ($array as $key) {
        foreach ($key as $ey => $value) {
            @$total .= $value . '-';
            $o++;
        }
    }
    $cadena = $total;
    // Convertimos la cadena en un array de números
    $numeros = explode("-", $cadena);
    // Declaramos una variable para almacenar la suma
    $suma = 0;
    // Iteramos sobre el array de números
    foreach ($numeros as $numero) {
        // Convertimos cada número a un número entero
        $numeroEntero = intval($numero);
        // Sumamos el número al acumulado
        $suma += $numeroEntero;
    }
    return $suma;
}

// definimos array de datos 
$json = $new->userStats($dat['lunes'], $dat['domingo']);
$promedio_diario1 = total($json) / 7;
$jsa = $new->solicitudStats($dat['lunes'], $dat['domingo']);
$promedio_diario2 = total($jsa) / 7;
$jsc = $new->archivesStats($dat['lunes'], $dat['domingo']);
$promedio_diario3 = total($jsc) / 7;


// limitamos los promedios a 2 caracteres despues de la coma
$promedio_diario1 = number_format($promedio_diario1, 2);
$promedio_diario2 = number_format($promedio_diario2, 2);
$promedio_diario3 = number_format($promedio_diario3, 2);

// enviamos los datos como cadena json
echo json_encode([$json, $jsa, $jsc, $dat, $promedio_diario1, $promedio_diario2, $promedio_diario3]);
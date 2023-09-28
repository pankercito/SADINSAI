<?php

$tipo = [null, 1, null, null];

function soloUnValor($array)
{
    // Comprobar si el array tiene solo un campo NO null
    if (
        count(array_filter($array, function ($value) {
            return $value !== null;
        })) == 1
    ) {
        // Si tiene solo un campo NO null, convertirlo en string
        return implode(', ', array_filter($array));
    } else {
        // Si tiene más de un campo NO null, ordenarlo y devolverlo
        return array_values(array_filter($array));
    }
}

$var = soloUnValor($tipo);

if (is_array($var)) {
    echo var_dump($var);
} else {
    echo  $var;
}
<?php

function generarId() {
    // Genera un número aleatorio de 12 dígitos
    $number = str_pad(random_int(1, 99999999), 8, '0', STR_PAD_LEFT);

    // Devuelve el número aleatorio
    return $number;
}
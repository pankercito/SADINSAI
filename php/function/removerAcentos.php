<?php

function remover_acentos($cadena) {
    /* Remueve los acentos de una cadena de texto */
    $no_acentos = strtr(utf8_decode($cadena), utf8_decode('áéíóúÁÉÍÓÚüÜ'), 'aeiouAEIOUuU');
    return utf8_encode($no_acentos);
}
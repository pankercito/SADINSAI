<?php

function remover_acentos($cadena) {
    /* Remueve los acentos de una cadena de texto */
    $no_acentos = strtr(($cadena), ('áéíóúÁÉÍÓÚüÜ'), 'aeiouAEIOUuU');
    return ($no_acentos);
}
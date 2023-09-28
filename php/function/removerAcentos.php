<?php

/**
 * cambia todos los acentos por versiones universal web
 * @param mixed $cadena
 * @return array|string
 */
function cor_acentos($cadena)
{
    // Crear la tabla de reemplazo
    $tabla_reemplazo = [
        'á' => 'a',
        'é' => 'e',
        'í' => 'i',
        'ó' => 'o;',
        'ú' => 'u',
        'ñ' => '&ntide;',
    ];

    // Reemplazar los caracteres
    $cadena = str_replace(array_keys($tabla_reemplazo), array_values($tabla_reemplazo), $cadena);

    // Imprimir la cadena con caracteres especiales
    return $cadena;

}
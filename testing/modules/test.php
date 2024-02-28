<?php
function obtenerExtension($nombreArchivo)
{
    $posicionPunto = strrpos($nombreArchivo, '.');
    if ($posicionPunto === false) {
        return '';
    } else {
        return substr($nombreArchivo, $posicionPunto + 1);
    }
}

echo obtenerExtension('jop.jpg');
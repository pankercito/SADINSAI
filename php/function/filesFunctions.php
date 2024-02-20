<?php

/**
 * mueve el archivo indexado a la direccion especificada
 * @param mixed $archivo tmp del archivo
 * @param string $destino direccion de carpeta a donde mover
 * @param string $nombreDelArchivo nombre de alternativo || null = "sin_nombre"
 * @return bool
 */
function moveFile($archivo, $destino, $nombreDelArchivo = 'sin_nombre')
{
    // Crear carpeta sino existe
    if (!file_exists($destino)) {
        mkdir($destino, 0777, true);
    }
    // mover archivo a su carpeta
    if (move_uploaded_file($archivo, $destino . "/" . $nombreDelArchivo)) {
        return true;
    } else {
        return false;
    }
}

/**
 * Obtiene la extencion del string introducido
 * _ejemp:_
 * _abc.jpg => return jpg_
 * @param mixed $name nombre del archivo,1-
 * @return mixed extencion del archivo || null = "no_espesificado"
 */
function extencion($name)
{
    $path = $name;

    $info = pathinfo($path);

    $extension = isset($info['extension']) ? $info['extension'] : 'no_espesificado';

    return $extension;
}
    
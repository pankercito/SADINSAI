<?php
require "criptCodes.php";

/**
 * Summary of searching
 * @param mixed $keys
 * @param mixed $conn
 * @return array 
 */
function searching($keys, $conn)
{
    $vef = strpos($keys, " ");

    if ($vef === false) {
        $searching = $conn->query("SELECT ci, nombre, apellido FROM personal WHERE ci LIKE '$keys%' OR nombre LIKE '$keys%' OR apellido LIKE '$keys%' LIMIT 0, 6");
    } else {
        $key1 = substr($keys, 0, $vef);
        $key2 = substr($keys, $vef + 1);

        $searching = $conn->query("SELECT ci, nombre, apellido FROM personal WHERE ci LIKE '$keys%' OR nombre LIKE '$key1%' AND apellido LIKE '$key2%' LIMIT 0, 6");
    }

    $export = [];

    while ($v = $searching->fetch_object()) {
        $export[] = [
            "ci" => encriptar($v->ci),
            "nombre" => $v->nombre,
            "apellido" => $v->apellido
        ];
    }

    return $export ?: null;
}
<?php

require "class/conx.php";
require "function/criptCodes.php";

$conn = new Conexion;

$keys = $conn->real_escape($_POST["keys"]);

$searching = $conn->query("SELECT ci, nombre, apellido FROM personal WHERE ci LIKE '$keys%' OR nombre LIKE '$keys%' OR apellido LIKE '$keys%' LIMIT 0, 6");

while ($v = $searching->fetch_object()) {
    $export[] = [
        "ci" => encriptar($v->ci),
        "nombre" => $v->nombre,
        "apellido" => $v->apellido
    ];
}

echo json_encode($export);
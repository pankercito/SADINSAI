<?php

require("conx.php");
require("function/criptCodes.php");

$conn = new Conexion;

$keys = $conn->real_escape($_POST["keys"]);

$searching = $conn->query("SELECT ci, nombre, apellido FROM personal WHERE ci LIKE '$keys%' OR nombre LIKE '$keys%' OR apellido LIKE '$keys%' LIMIT 0, 6");

while ($v = $searching->fetch_object()) {
    $export[] = [
        '<li><a class="searched" href="perfil.php?personal=' . encriptar($v->ci) . '&parce=true">' . $v->ci . ' | ' . ucfirst(strtolower($v->nombre)) . ' ' . ucfirst(strtolower($v->apellido)) . '</a></li>'
    ];
}

echo json_encode($export);
<?php

require "../php/class/conx.php";
require "../php/function/searchin.php";

$conn = new Conexion;

@$keys = $conn->real_escape(trim($_POST["keys"]));

$searching = searching($keys, $conn);

if (is_array($searching)) {
    foreach ($searching as $v) {
        $export[] = [
            '<li class="nav-item"><a class="nav-link collapsed searched" href="../public/perfil.php?perfil=' . $v['ci'] . '&parce=true">' . desencriptar($v['ci']) . ' | ' . ucfirst(strtolower($v['nombre'])) . ' ' . ucfirst(strtolower($v['apellido'])) . '</a></li>'
        ];
    }
}

echo json_encode(@$export);
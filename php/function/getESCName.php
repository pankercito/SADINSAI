<?php


function getNameEsc($estado, $ciudad, $sede)
{
    $conn = new Conexion();
    
    $estado = $conn->real_escape($estado);
    $ciudad = $conn->real_escape($ciudad);
    $sede = $conn->real_escape($sede);

    $es = $conn->query("SELECT * FROM estados WHERE id_estado = $estado");
    $ci = $conn->query("SELECT * FROM ciudades WHERE id_ciudad = $ciudad");
    $se = $conn->query("SELECT * FROM sedes WHERE sede_id = $sede");

    if ($es && $ci && $se) {
        $e = mysqli_fetch_assoc($es);
        $c = mysqli_fetch_assoc($ci);
        $s = mysqli_fetch_assoc($se);
    
        $array = [
            "estado" => $e['estado'],
            "ciudad" => $c['ciudad'],
            "sede" => $s['nombre_sede'],
        ];
    }
    $conn->close();
    return $array;
}
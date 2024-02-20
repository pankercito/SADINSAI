<?php

include "../../php/class/conx.php";

$con = new Conexion();

$q = $con->query("SELECT * FROM registro");
print_r($q->num_rows);

while ($a = $q->fetch_object()) {
    echo $a->id_usuario . '<br>';

    $dart = $con->query("SELECT * FROM solicitudes_y_permisos WHERE ci_permiso = '{$a->ci}'");

    while ($e = $dart->fetch_object()) {
        echo $e->ci_permiso . '<br>';
    }



}
<?php

include "../preset/presetConfigIncludes.php";

$conn = new Conexion;
$auditoria = new AuditoriaGeneral;

$nombre = $conn->real_escape(trim($_POST["cargo"]));

$verfy = $conn->query("SELECT * FROM cargo WHERE cargo_nombre = '$nombre'");

$vacie = $verfy->num_rows;

if ($vacie == 0) {
    $vrfy = $conn->query("INSERT INTO cargo (cargo_nombre) VALUES ('$nombre')");
    if ($vrfy == true) {
        if ($auditoria->nuevoCargo($nombre)) {
            echo "success";
        }
    } else {
        echo "query.error";
    }
} else {
    echo "dupli";
}
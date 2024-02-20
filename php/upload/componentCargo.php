<?php

include "../class/conx.php";

$conn = new Conexion();

$cargo = $conn->real_escape(trim($_POST["cargo"]));

$verfy = $conn->query("SELECT * FROM cargo WHERE cargo_nombre = '$cargo'");

$vacie = $verfy->num_rows;

if ($vacie == 0) {
    $vrfy = $conn->query("INSERT INTO cargo (cargo_nombre) VALUES ('$cargo')");
    if ($vrfy == true) {

        echo "success";
    } else {

        echo "query.error";
    }
} else {
    echo "dupli";
}
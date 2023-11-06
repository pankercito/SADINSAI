<?php

include "conx.php";
include "class/auditoria.php";

$conn = new Conexion();
$auditoria = new Auditoria();

$user = $conn->real_escape($_POST['userId']);

$a = $auditoria->deleleUser($user);

if ($a == true) {
    echo "success.dele";
} else {
    echo "error.dele";
}

$conn->close();
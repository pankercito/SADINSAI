<?php


include "class/conx.php";
include "function/getUser.php";
include "class/auditoria.php";
include "class/user_model.php";
include "class/gestionUsuarios.php";

$conn = new Conexion();

$id = $conn->real_escape(trim($_POST['userId']));

$ges = new GestionDeUsuarios();
$auditoria = $ges->byId($id);

$a = $auditoria->deleteUser();

if ($a == true) {
    echo "success.dele";
} else {
    echo "error.dele";
}

$conn->close();
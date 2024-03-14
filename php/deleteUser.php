<?php

include "../php/configIncludes.php";

$conn = new Conexion();

$id = $conn->real_escape(trim($_POST['userId']));

$ges = new User(getUserHash($id));
$gestionDeUsuario = new UserUseCase($ges);

$a = $gestionDeUsuario->eliminarUsuario();

if ($a == true) {
    echo "success.dele";
} else {
    echo "error.dele";
}

$conn->close();
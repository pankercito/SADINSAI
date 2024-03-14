<?php

include "../php/configIncludes.php";

if ($_POST['userId'] != "") {

    $conn = new Conexion();
    $userID = $conn->real_escape(trim($_POST['userId']));

    $gestionDeUsuario = new UserUseCase(new User(getUserHash($userID)));

    $radio = $conn->real_escape($_POST['radio']);
    switch ($radio) {
        case '1':

            $aa = $gestionDeUsuario->activarUsuario();

            if ($aa == true) {
                echo "success";
            } else {
                echo "error";
            }
            break;
        case '2':
            $aa = $gestionDeUsuario->desactivarUsuario();

            if ($aa == true) {
                echo "success.rech";
            } else {
                echo "error.rech";
            }
            break;
        default:
            echo "error";
            break;
    }
} else {
    echo "vacio";
}

$conn->close();
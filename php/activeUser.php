<?php

include "class/classIncludes.php";
include "function/getUser.php";

if ($_POST['userId'] != "") {

    $conn = new Conexion();
    $userID = $conn->real_escape(trim($_POST['userId']));

    $ges = new GestionDeUsuarios();
    $auditoria = $ges->byId($userID);


    $radio = $conn->real_escape($_POST['radio']);
    switch ($radio) {
        case '1':

            $aa = $auditoria->activarUsuario();

            if ($aa == true) {
                echo "success";
            } else {
                echo "error";
            }
            break;
        case '2':
            $aa = $auditoria->supenderUsuario();

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
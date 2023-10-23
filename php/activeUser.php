<?php
include "conx.php";
include "class/auditoria.php";

if ($_POST['userId'] != "") {

    $conn = new Conexion();
    $auditoria = new Auditoria();

    $user = $conn->real_escape($_POST['userId']);
    $radio = $conn->real_escape($_POST['radio']);

    switch ($radio) {
        case '1':



            if ($auditoria->registActivUser()) {
                $sql = $conn->query("UPDATE registro SET active = '$radio' WHERE id_usuario = '$user'");

                if ($sql == true) {
                    echo "success";
                } else {
                    echo "error";
                }
            } else {
                echo "error";
            }

            break;
        case '2':
            if ($auditoria->registActivUser()) {
                $sql = $conn->query("UPDATE registro SET active = '$radio' WHERE id_usuario = '$user'");

                if ($sql == true) {
                    echo "success.rech";
                } else {
                    echo "error.rech";
                }
            } else {
                echo "error";
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
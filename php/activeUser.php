<?php
include("conx.php");

if ($_POST['pin'] != "") {

    $conn = new Conexion();

    $user = $conn->real_escape($_POST['userId']);
    $radio = $conn->real_escape($_POST['radio']);

    switch ($radio) {
        case '1':
            $sql = $conn->query("UPDATE registro SET active = '$radio' WHERE id_usuario = '$user'");

            if ($sql == true) {
                echo "success";
            }else{
                echo "error";
            }
            break;
        case '2':
            $sql = $conn->query("UPDATE registro SET active = '$radio' WHERE id_usuario = '$user'");
            if ($sql == true) {
                echo "success.rech";
            }else{
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
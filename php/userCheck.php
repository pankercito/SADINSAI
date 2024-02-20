<?php

include "class/conx.php";

if ($_POST['user'] != "") {
    $conn = new Conexion();

    $user = $conn->real_escape($_POST['user']);

    $sql = $conn->query("SELECT user FROM registro WHERE user = '$user'");

    $num = mysqli_num_rows($sql);

    if ($num != "1") {
        echo "success";
    } else {
        echo "exist";
    }
    $conn->close();
}else{
    echo "vacio";
}
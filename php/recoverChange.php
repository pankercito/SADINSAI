<?php

include("conx.php");
include("function/criptCodes.php");

if (isset($_POST["ci"])) {

    $conn = new Conexion();

    $ci = $conn->real_escape($_POST["ci"]);
    $new_pass = encriptar($conn->real_escape($_POST["pass"]));

    @$d = $conn->query("SELECT * FROM registro WHERE ci = $ci");

    if ($d->num_rows == 1) {

        @$u = $conn->query("UPDATE registro SET pass = '$new_pass' WHERE ci = '$ci'");

        if ($u == true) {
           echo "se cambio la contraseña correctamente";
        }else{
           echo "error al cambiar la contraseña";
        }

    } else {
        echo "error al leer datos";
    }

} else {
    echo "nollego";
}
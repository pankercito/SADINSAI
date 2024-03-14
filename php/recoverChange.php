<?php

include "../php/configIncludes.php";

if (isset($_POST["ci"])) {

    $conn = new Conexion();

    $ci = encriptar($conn->real_escape($_POST["ci"]));
    $new_pass = $conn->real_escape($_POST["pass"]);

    $user = new User($ci);

    $u = new UserUseCase($user);

    if ($u->cambiarHash($new_pass)) {
        echo "se cambio la contraseña correctamente";
    } else {
        echo "error al cambiar la contraseña";
    }

} else {
    echo "nollego";
}

session_unset();
session_destroy();
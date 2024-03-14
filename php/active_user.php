<?php

include "../php/configIncludes.php";

if ($_POST['ci'] != "") {
    session_start();

    $conn = new Conexion();
    $userCi = trim($conn->real_escape($_POST['ci']));
    $user = new User(getUserHash(null, $userCi));

    $_SESSION['sesion'] = $user->getUserId();
    $gestionDeUsuario = new UserUseCase($user);

    switch ($user->active) {
        case 1:
            echo 'active';
            break;
        case 2:
            echo 'inhabilited';
            break;
        default:
            if ($gestionDeUsuario->activarUsuario()) {
                echo "success";
            }
            break;
    }

    session_destroy();
    session_unset();
}
<?php

include "class/classIncludes.php";
include "function/getUser.php";
include "function/criptCodes.php";

$conn = new Conexion();

$userCi = trim($conn->real_escape($_POST['ci']));

if ($userCi != "") {

    $user = new UserModel(getUserData(null, $userCi));
    $auditoria = new GestionDeUsuarios($user);

    switch ($user->active) {
        case '1':
            echo 'active';
            break;
        default:
            if ($auditoria->activarUsuario()) {
                echo "success";
            }
            break;
    }

}
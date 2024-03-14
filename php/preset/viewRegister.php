<?php

include "../preset/presetConfigIncludes.php";

session_start();

$users = new SystemUser;

foreach ($users->usersList() as $v) {

    $delete = ($users->adpUserLogged() == 2) ? '<span class="e mx-1"></span><a  onclick="deleteUser(' . $v->getUserId() . ')" class="pencil alert alert-danger"><i class="bi bi-trash"></i></a>' : "";

    $paradmi = ($users->adpUserLogged() == 2) ? '<span class="e mx-1"></span><a onclick="gestionUser(' . $v->getUserId() . ')" class="pencil alert alert-warning" ><i class="bi bi-pencil"></i></a>' . $delete . '</div>' : '';

    $class = ($users->adpUserLogged() == 2) ? '<div class="d-inline-flex">' : '<div>';

    $r = ($v->active != 1) ? '<div class="d-inline-flex"><a class="alert alert-secondary">desactivado</a>' . $paradmi
        : $class . '<a class="panel alert alert-success">activo</a>' . $paradmi;

    // ICONO DE USUARIO
    $ad = ($v->adp == 1) ? '<i class="admin me-2 bi bi-person-fill-gear"></i>' : '<i class="no-admin me-2 bi bi-person"></i>';

    $g = ($users->adpUserLogged() == 1) ? 'no-proper' : 'no-proper';

    if ($v->sesion != $v->getUserId()) {
        if ($v->adp != 2) {
            // Poner los datos en un array en el orden de los campos de la tabla
            $data[] = [
                "<a class='vrname " . $g . "' onclick=location.replace('perfil.php?perfil=" . encriptar($v->ci) . "&parce=true')>" . $ad . strtoupper(strtolower($v->usuario)) . "</a>",
                ucwords(strtolower($v->nombre)),
                ucwords(strtolower($v->apellido)),
                $v->ci,
                $r
            ];
        }
    }
}


echo json_encode(['data' => $data]);
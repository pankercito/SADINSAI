<?php

if (!class_exists('Conexion')) {
    include "../php/configIncludes.php";
}

@session_start();

$conn = new Conexion();

// REESTABLECER EVENTO EN BDs
if (isset($_SESSION['sesion'])) {

    $na = new User(getUserHash($_SESSION['sesion']));
    $nueva_hora = hora10();
    $evento = $_SESSION['event'];

    $sn = new UserUseCase($na);

    if ($na->sesion != 1) {
        $sn->inicioDeSesion();
    }

    $delevent = "DROP EVENT IF EXISTS $evento";
    $sql = $conn->query($delevent);

    $event = "CREATE EVENT $evento ON SCHEDULE AT '$nueva_hora' DO UPDATE registro r SET sesion = '0' WHERE r.id_usuario = '{$na->getUserId()}'";
    $sql = $conn->query($event);

    $_SESSION['LAST_ACTIVITY'] = time();
} else {
    echo 'expirado';
}

// Actualizar la última actividad de la sesión
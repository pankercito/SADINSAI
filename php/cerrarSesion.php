<?php

include "../php/configIncludes.php";

session_start();

if (isset($_SESSION['sesion'])) {

    $conn = new Conexion;
    $s = new User(getUserHash($_SESSION['sesion']));

    if (isset($_SESSION['event'])) {
        $d = new UserUseCase($s);
        $a = new UserAuditoria;

        if ($a->cierreDeSesion() && $d->cierreDeSesion()) {

            $evento = $_SESSION['event'];

            $delevent = "DROP EVENT IF EXISTS $evento";
            $sql = $conn->query($delevent);

            session_destroy();
            session_unset();

            header("Location: ../index.php");
        }
    }
} else {
    session_destroy();
    session_unset();
    header("Location: ../index.php");
}
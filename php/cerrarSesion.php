<?php

session_start();

if (isset($_SESSION['sesion'])) {
    include "class/classIncludes.php";
    include "function/sesion.php";

    $conn = new Conexion;
    $s = $_SESSION['sesion'];

    if (isset($_SESSION['event'])) {
        $d = new Auditoria();
        if ($d->sesionClose($s) && outSesion($s)) {
           
            $evento = $_SESSION['event'];
            echo $evento;
            $delevent = "DROP EVENT IF EXISTS $evento";
            $sql = $conn->query($delevent);
            session_destroy();
            session_unset();
            header("Location: ../index.php");
        }
    }
}else {
    session_destroy();
    session_unset();
    header("Location: ../index.php");
}
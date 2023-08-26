<?php

session_start();

if (isset($_SESSION['sesion'])) {
    include("conx.php");
    include("function/sesion.php");
    include("class/auditoria.php");

    $s = $_SESSION['sesion'];
    $conn = new Conexion;

    if (isset($_SESSION['event'])) {
        $d = new auditoria();
        if ($d->auditoriaSesionClose($s) && outSesion($s)) {
           
            $evento = $_SESSION['event'];
            echo $evento;
            $delevent = "DROP EVENT IF EXISTS $evento";
            $sql = $conn->query($delevent);
            session_destroy();
            session_unset();
            header("Location: ../index.php");
        }
    }
}
<?php

require "class/auditoria.php";
require "conx.php";

date_default_timezone_set('America/Caracas');

$selector = $_POST['selectipo'];

@session_start();

$auditoria = new Auditoria();
$conn = new Conexion();

switch ($selector) {
    case '1':
        # SOLICITUDES
        @$fecha = ($_POST['fecha'] != null) ? $_POST['fecha'] : null;
        @$fecha2 = ($_POST["fecha2"] != null) ? $_POST["fecha2"] : null;
        @$aceptadas = ($_POST["aceptadas"] != null) ? $_POST["aceptadas"] : null;
        @$rechazadas = ($_POST["rechazadas"] != null) ? $_POST["rechazadas"] : null;

        if ($aceptadas != null) {
            $estado = $aceptadas;
        } elseif ($rechazadas != null) {
            $estado = $rechazadas;
        } else {
            $estado = null;
        }

        $data = $auditoria->solicitudPrecise($fecha, $fecha2, $estado);

        $_SESSION['reporteSolis'] = $data;

        echo json_encode($_SESSION['reporteSolis']);

        break;

    case '2':
        # ARCHIVOS
        @$fecha = ($_POST['fecha'] != null) ? $_POST['fecha'] : null;
        @$fecha2 = ($_POST["fecha2"] != null) ? $_POST["fecha2"] : null;
        @$archagregados = ($_POST["archagregados"] != null) ? 0 : null;
        @$eliminadosarchivos = ($_POST["eliminadosarchivos"] != null) ? 1 : null;
        @$edicion = ($_POST["edicionpersonal"] != null) ? $_POST["edicionpersonal"] : null;
        @$ubi = ($_POST["ubicación"] != null) ? $_POST["ubicación"] : null;

        $tipo = [$ubi, $edicion, $eliminadosarchivos, $archagregados];

        $estado = null;

        if ($eliminadosarchivos != null) {
            $estado = $archagregados;
        } else if ($archagregados != null) {
            $estado = $eliminadosarchivos;
        }

        $data = $auditoria->archivesDetailsStats($fecha, $fecha2, $estado);

        $_SESSION['reporteArch'] = $data;

        echo var_dump($_SESSION['reporteArch']);

        break;

    case '3':
        # USUARIOS
        @$fecha = ($_POST['fecha'] != null) ? $_POST['fecha'] : null;
        @$fecha2 = ($_POST["fecha2"] != null) ? $_POST["fecha2"] : null;
        @$solisrealizadas = ($_POST["solisrealizadas"] != null) ? $_POST["solisrealizadas"] : null;

        if ($solisrealizadas == 1) {
            $data = $auditoria->userInixStats($fecha, $fecha2);
            $_SESSION['reporteUsersInix'] = $data;
            echo json_encode($_SESSION['reporteUsersInix']);
        }

        if ($solisrealizadas == 2 || $fecha == null && $solisrealizadas != 1) {
            $data = $auditoria->userSolisStats($fecha, $fecha2);
            $_SESSION['reporteUsersUsers'] = $data;
            echo json_encode($_SESSION['reporteUsersUsers']);
        }
        break;

    default:

        $_SESSION['general'] = true;

        # SOLICITUDES *****************************************************
        @$fecha = ($_POST['fecha'] != null) ? $_POST['fecha'] : null;
        @$fecha2 = ($_POST["fecha2"] != null) ? $_POST["fecha2"] : null;
        @$aceptadas = ($_POST["aceptadas"] != null) ? $_POST["aceptadas"] : null;
        @$rechazadas = ($_POST["rechazadas"] != null) ? $_POST["rechazadas"] : null;


        if ($aceptadas != null) {
            $estado = $aceptadas;
        } elseif ($rechazadas != null) {
            $estado = $rechazadas;
        } else {
            $estado = null;
        }

        $data = $auditoria->solicitudPrecise($fecha, $fecha2, $estado);

        $_SESSION['reporteSolis'] = $data;

        echo json_encode($_SESSION['reporteSolis']);

        # ARCHIVOS*****************************************************

        @$fecha = ($_POST['fecha'] != null) ? $_POST['fecha'] : null;
        @$fecha2 = ($_POST["fecha2"] != null) ? $_POST["fecha2"] : null;
        @$archagregados = ($_POST["archagregados"] != null) ? 0 : null;
        @$eliminadosarchivos = ($_POST["eliminadosarchivos"] != null) ? 1 : null;
        @$edicion = ($_POST["edicionpersonal"] != null) ? $_POST["edicionpersonal"] : null;
        @$ubi = ($_POST["ubicación"] != null) ? $_POST["ubicación"] : null;

        $tipo = [$ubi, $edicion, $eliminadosarchivos, $archagregados];

        $estado = null;

        if ($eliminadosarchivos != null) {
            $estado = $archagregados;
        } else if ($archagregados != null) {
            $estado = $eliminadosarchivos;
        }

        $data = $auditoria->archivesDetailsStats($fecha, $fecha2, $estado);

        $_SESSION['reporteArch'] = $data;

        echo json_encode($_SESSION['reporteArch']);

        # USUARIOS *****************************************************

        @$fecha = ($_POST['fecha'] != null) ? $_POST['fecha'] : null;
        @$fecha2 = ($_POST["fecha2"] != null) ? $_POST["fecha2"] : null;
        @$solisrealizadas = ($_POST["solisrealizadas"] != null) ? $_POST["solisrealizadas"] : null;

        $data = $auditoria->userSolisStats($fecha, $fecha2);
        $_SESSION['reporteUsersUsers'] = $data;
        echo json_decode($_SESSION['reporteUsersUsers']);

        break;
}
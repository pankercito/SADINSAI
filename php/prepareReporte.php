<?php

require "class/classIncludes.php";

date_default_timezone_set('America/Caracas');

$selector = $_POST['selectipo'];

@session_start();

$auditoria = new Estadistica();
$conn = new Conexion();

switch ($selector) {
    case '1':
        # GESTIONES
        @$fecha = ($_POST['fecha'] != null) ? $_POST['fecha'] : null;
        @$fecha2 = ($_POST["fecha2"] != null) ? $_POST["fecha2"] : null;
        @$aceptadas = ($_POST["aceptadas"] != null) ? $_POST["aceptadas"] : null;

        if ($aceptadas != null) {
            $estado = $aceptadas;
        } else {
            $estado = null;
        }

        $data = $auditoria->gestionPrecise($fecha, $fecha2, $estado);

        $_SESSION['reporteGestion'] = $data;

        echo json_encode($_SESSION['reporteGestion']);
        break;

    case '2':
        #SOLICITUDES
        @$fecha = ($_POST['fecha'] != null) ? $_POST['fecha'] : null;
        @$fecha2 = ($_POST["fecha2"] != null) ? $_POST["fecha2"] : null;
        @$aceptadas = ($_POST["aceptadas"] != null) ? $_POST["aceptadas"] : null;

        $estado = ($aceptadas != null) ? $aceptadas : null;

        $data = $auditoria->SolisPrecise($fecha, $fecha2, $estado);

        $_SESSION['reporteSolis'] = $data;

        echo json_encode($_SESSION['reporteSolis']);
        break;

    case '3':
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

    case '4':
        # USUARIOS
        @$fecha = ($_POST['fecha'] != null) ? $_POST['fecha'] : null;
        @$fecha2 = ($_POST["fecha2"] != null) ? $_POST["fecha2"] : null;
        @$solisrealizadas = ($_POST["solisrealizadas"] != null) ? $_POST["solisrealizadas"] : null;

        if ($solisrealizadas == 1) {
            $data = $auditoria->userInixStats($fecha, $fecha2);
            $_SESSION['reporteUsersInix'] = $data;
            echo json_encode($_SESSION['reporteUsersInix']);
            exit;
        }

        if ($solisrealizadas == 2) {
            $data = $auditoria->userSolisStats($fecha, $fecha2);
            $_SESSION['reporteSolisUser'] = $data;
            echo json_encode($_SESSION['reporteSolisUser']);
            exit;
        }

        if ($solisrealizadas == 3 || $fecha == null) {
            $data = $auditoria->userGestionStats($fecha, $fecha2);
            $_SESSION['reporteUsersUsers'] = $data;
            echo json_encode($_SESSION['reporteUsersUsers']);
        }
        break;
    default:

        $_SESSION['general'] = true;

        # GESTION *****************************************************
        @$fecha = ($_POST['fecha'] != null) ? $_POST['fecha'] : null;
        @$fecha2 = ($_POST["fecha2"] != null) ? $_POST["fecha2"] : null;
        @$aceptadas = ($_POST["aceptadas"] != null) ? $_POST["aceptadas"] : null;

        if ($aceptadas != null) {
            $estado = $aceptadas;
        } else {
            $estado = null;
        }

        $data = $auditoria->gestionPrecise($fecha, $fecha2, $estado);

        $_SESSION['reporteGestion'] = $data;

        echo json_encode($_SESSION['reporteGestion']);

        # SOLICITUDES *****************************************************
        @$fecha = ($_POST['fecha'] != null) ? $_POST['fecha'] : null;
        @$fecha2 = ($_POST["fecha2"] != null) ? $_POST["fecha2"] : null;
        @$aceptadas = ($_POST["aceptadas"] != null) ? $_POST["aceptadas"] : null;

        $estado = ($aceptadas != null) ? $aceptadas : null;

        $data = $auditoria->SolisPrecise($fecha, $fecha2, $estado);

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

        $data = $auditoria->userGestionStats($fecha, $fecha2);
        $_SESSION['reporteUsersUsers'] = $data;
        
        echo json_decode($_SESSION['reporteUsersUsers']);

        break;
}
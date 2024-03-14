<?php

require "../php/configIncludes.php";

date_default_timezone_set('America/Caracas');

$selector = $_POST['selectipo'];

@session_start();

$gestionDeUsuario = new Estadistica();
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

        $data = $gestionDeUsuario->gestionPrecise($fecha, $fecha2, $estado);

        $_SESSION['reporteGestion'] = $data;

        echo json_encode($_SESSION['reporteGestion']);
        break;

    case '2':
        #SOLICITUDES
        @$fecha = ($_POST['fecha'] != null) ? $_POST['fecha'] : null;
        @$fecha2 = ($_POST["fecha2"] != null) ? $_POST["fecha2"] : null;
        @$aceptadas = ($_POST["aceptadas"] != null) ? $_POST["aceptadas"] : null;

        $estado = ($aceptadas != null) ? $aceptadas : null;

        $data = $gestionDeUsuario->solisPrecise($fecha, $fecha2, $estado);

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

        $data = $gestionDeUsuario->archivesDetailsStats($fecha, $fecha2, $estado);

        $_SESSION['reporteArch'] = $data;

        echo json_encode($_SESSION['reporteArch']);

        break;

    case '4':
        # USUARIOS
        @$fecha = ($_POST['fecha'] != null) ? $_POST['fecha'] : null;
        @$fecha2 = ($_POST["fecha2"] != null) ? $_POST["fecha2"] : null;
        @$solisrealizadas = ($_POST["solisrealizadas"] != null) ? $_POST["solisrealizadas"] : null;

        if ($solisrealizadas == 1) {
            $data = $gestionDeUsuario->userInixStats($fecha, $fecha2);
            $_SESSION['reporteUsersInix'] = $data;
            echo json_encode($_SESSION['reporteUsersInix']);
            exit;
        }

        if ($solisrealizadas == 2) {
            $data = $gestionDeUsuario->userSolisStats($fecha, $fecha2);
            $_SESSION['reporteSolisUser'] = $data;
            echo json_encode($_SESSION['reporteSolisUser']);
            exit;
        }

        if ($solisrealizadas == 3 || $fecha == null) {
            $data = $gestionDeUsuario->userGestionStats($fecha, $fecha2);
            $_SESSION['reporteUsersUsers'] = $data;
            echo json_encode($_SESSION['reporteUsersUsers']);
            exit;
        }

        $data = $gestionDeUsuario->userInixStats($fecha, $fecha2);
        $_SESSION['reporteUsersInix'] = $data;
        echo json_encode($_SESSION['reporteUsersInix']);

        break;
    default:

        $_SESSION['general'] = true;


        # GESTIONES*****************************************************
        @$fecha = ($_POST['fecha'] != null) ? $_POST['fecha'] : null;
        @$fecha2 = ($_POST["fecha2"] != null) ? $_POST["fecha2"] : null;
        @$aceptadas = ($_POST["aceptadas"] != null) ? $_POST["aceptadas"] : null;

        if ($aceptadas != null) {
            $estado = $aceptadas;
        } else {
            $estado = null;
        }

        $data = $gestionDeUsuario->gestionPrecise($fecha, $fecha2, $estado);

        $_SESSION['reporteGestion'] = $data;

        echo json_encode($_SESSION['reporteGestion']);

        # SOLICITUDES*****************************************************
        @$fecha = ($_POST['fecha'] != null) ? $_POST['fecha'] : null;
        @$fecha2 = ($_POST["fecha2"] != null) ? $_POST["fecha2"] : null;
        @$aceptadas = ($_POST["aceptadas"] != null) ? $_POST["aceptadas"] : null;

        $estado = ($aceptadas != null) ? $aceptadas : null;

        $data = $gestionDeUsuario->solisPrecise($fecha, $fecha2, $estado);

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

        $data = $gestionDeUsuario->archivesDetailsStats($fecha, $fecha2, $estado);

        $_SESSION['reporteArch'] = $data;

        echo json_encode($_SESSION['reporteArch']);

        
        # USUARIOS *****************************************************

        @$fecha = ($_POST['fecha'] != null) ? $_POST['fecha'] : null;
        @$fecha2 = ($_POST["fecha2"] != null) ? $_POST["fecha2"] : null;
        @$solisrealizadas = ($_POST["solisrealizadas"] != null) ? $_POST["solisrealizadas"] : null;

        if ($solisrealizadas == 1) {
            $data = $gestionDeUsuario->userInixStats($fecha, $fecha2);
            $_SESSION['reporteUsersInix'] = $data;
            echo json_encode($_SESSION['reporteUsersInix']);
            exit;
        }

        if ($solisrealizadas == 2) {
            $data = $gestionDeUsuario->userSolisStats($fecha, $fecha2);
            $_SESSION['reporteSolisUser'] = $data;
            echo json_encode($_SESSION['reporteSolisUser']);
            exit;
        }

        if ($solisrealizadas == 3 || $fecha == null) {
            $data = $gestionDeUsuario->userGestionStats($fecha, $fecha2);
            $_SESSION['reporteUsersUsers'] = $data;
            echo json_encode($_SESSION['reporteUsersUsers']);
        }

        $data = $gestionDeUsuario->userInixStats($fecha, $fecha2);
        $_SESSION['reporteUsersInix'] = $data;
        echo json_encode($_SESSION['reporteUsersInix']);

        break;
}
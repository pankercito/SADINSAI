<?php

require "class/auditoria.php";
require "conx.php";

date_default_timezone_set('America/Caracas');

$selector = $_POST['selectipo'];

@session_start();

$auditoria = new auditoria();
$conn = new Conexion();

switch ($selector) {
    case '1':
        # SOLICITUDES

        @$fecha = ($_POST['fecha'] != null) ? $_POST['fecha'] : null;
        @$fecha2 = ($_POST["fecha2"] != null) ? $_POST["fecha2"] : null;
        @$aceptadas = ($_POST["aceptadas"] != null) ? $_POST["aceptadas"] : null;
        @$rechazadas = ($_POST["rechazadas"] != null) ? $_POST["rechazadas"] : null;
        @$ingreso = ($_POST["ingresopersonal"] != null) ? $_POST["ingresopersonal"] : null;
        @$edicion = ($_POST["edicionpersonal"] != null) ? $_POST["edicionpersonal"] : null;
        @$ingresoArchivo = ($_POST["edicionpersonal"] != null) ? $_POST["ingresoarchivos"] : null;
        @$eliminadas = ($_POST["eliminacionarchivos"] != null) ? $_POST["eliminacionarchivos"] : null;


        if ($aceptadas != null) {
            $estado = $aceptadas;
        } elseif ($rechazadas != null) {
            $estado = $rechazadas;
        } else {
            $estado = null;
        }

        $tipo = [$ingreso, $edicion, $ingresoArchivo, $eliminadas];

        function soloUnValor($array)
        {
            // Comprobar si el array tiene solo un campo NO null
            if (
                count(array_filter($array, function ($value) {
                    return $value !== null;
                })) == 1
            ) {
                // Si tiene solo un campo NO null, convertirlo en string
                return implode(', ', array_filter($array));
            } else {
                // Si tiene más de un campo NO null, ordenarlo y devolverlo
                return array_values(array_filter($array));
            }
        }

        $tipoV = soloUnValor($tipo);

        $data[] = $auditoria->solicitudPrecise($fecha, $fecha2, $estado, $tipoV);

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
        } elseif ($archagregados != null) {
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

        if ($solisrealizadas == 0) {
            $data = $auditoria->userInixStats($fecha, $fecha2);

            $_SESSION['reporteUsers'] = $data;

            echo var_dump($_SESSION['reporteUsers']);
            break;

        }
        if ($solisrealizadas == 1) {
            $data = $auditoria->userSolisStats($fecha, $fecha2);
            $_SESSION['reporteUsers'] = $data;
            echo var_dump($_SESSION['reporteUsers']);
            break;
        }

        break;
        
    default:
         # SOLICITUDES
         $_SESSION['general'] = true;

         @$fecha = ($_POST['fecha'] != null) ? $_POST['fecha'] : null;
         @$fecha2 = ($_POST["fecha2"] != null) ? $_POST["fecha2"] : null;
         @$aceptadas = ($_POST["aceptadas"] != null) ? $_POST["aceptadas"] : null;
         @$rechazadas = ($_POST["rechazadas"] != null) ? $_POST["rechazadas"] : null;
         @$ingreso = ($_POST["ingresopersonal"] != null) ? $_POST["ingresopersonal"] : null;
         @$edicion = ($_POST["edicionpersonal"] != null) ? $_POST["edicionpersonal"] : null;
         @$ingresoArchivo = ($_POST["edicionpersonal"] != null) ? $_POST["ingresoarchivos"] : null;
         @$eliminadas = ($_POST["eliminacionarchivos"] != null) ? $_POST["eliminacionarchivos"] : null;
 
 
         if ($aceptadas != null) {
             $estado = $aceptadas;
         } elseif ($rechazadas != null) {
             $estado = $rechazadas;
         } else {
             $estado = null;
         }
 
         $tipo = [$ingreso, $edicion, $ingresoArchivo, $eliminadas];
 
         function soloUnValor($array)
         {
             // Comprobar si el array tiene solo un campo NO null
             if (
                 count(array_filter($array, function ($value) {
                     return $value !== null;
                 })) == 1
             ) {
                 // Si tiene solo un campo NO null, convertirlo en string
                 return implode(', ', array_filter($array));
             } else {
                 // Si tiene más de un campo NO null, ordenarlo y devolverlo
                 return array_values(array_filter($array));
             }
         }
 
         $tipoV = soloUnValor($tipo);
 
         $data[] = $auditoria->solicitudPrecise($fecha, $fecha2, $estado, $tipoV);
 
         $_SESSION['reporteSolis'] = $data;
 
         echo json_encode($_SESSION['reporteSolis']);
 
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
         } elseif ($archagregados != null) {
             $estado = $eliminadosarchivos;
         }
 
         $data = $auditoria->archivesDetailsStats($fecha, $fecha2, $estado);
 
         $_SESSION['reporteArch'] = $data;
 
         echo var_dump($_SESSION['reporteArch']);
 
         # USUARIOS
         @$fecha = ($_POST['fecha'] != null) ? $_POST['fecha'] : null;
         @$fecha2 = ($_POST["fecha2"] != null) ? $_POST["fecha2"] : null;
         @$solisrealizadas = ($_POST["solisrealizadas"] != null) ? $_POST["solisrealizadas"] : null;
 
         if ($solisrealizadas == 0) {
             $data = $auditoria->userInixStats($fecha, $fecha2);
 
             $_SESSION['reporteUsers'] = $data;
 
             echo var_dump($_SESSION['reporteUsers']);
             break;
 
         }
         if ($solisrealizadas == 1) {
             $data = $auditoria->userSolisStats($fecha, $fecha2);
             $_SESSION['reporteUsers'] = $data;
             echo var_dump($_SESSION['reporteUsers']);
             break;
         }
 
        break;
}
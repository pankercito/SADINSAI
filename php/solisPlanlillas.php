<?php

include 'class/classIncludes.php';
include "function/idGenerador.php";

session_start();

if (isset($_POST['formtipo'])) {
    switch ($_POST['formtipo']) {
        case '1':

            $data = [
                $_POST['codigo'],
                $_POST['fecha'],
                $_POST['codigoNomina'],
                $_POST['inputNames'],
                $_POST['cargo'],
                $_POST['cin'],
                $_POST['adscrito'],
                $_POST['unidad'],
                $_POST['ubicacion'],
                $_POST['fechaingreso'],
                $_POST['organismos'],
                $_POST['tiempototal'],
                $_POST['motivode'],
                $_POST['observaciones']
            ];

            $paraquien = $_POST['cin'];

            //array de titulos nombres para guardar
            $nombres = [
                'codigo',
                'fecha',
                'codigo nomina',
                'nombre',
                'cargo',
                'cedula',
                'departamento',
                'unidad',
                'ubicacion',
                'fecha ingreso',
                'organismos',
                'tiempo total',
                'motivo de anticipo',
                'observaciones',
            ];

            $a = 0;
            foreach ($nombres as $key) {
                $array[$key] = $data[$a];
                $a++;
            }

            $siu = Solicitud::crearSolicitud(Solicitud::de_anticipo, $array, $paraquien);

            break;
        case '2':

            break;
        case '3':
            $data = [
                @$codigo = $_POST['codigo'],
                @$fecha = $_POST['fecha'],
                @$codigoNomina = $_POST['codigoNomina'],
                @$nombre = $_POST['inputNames'],
                @$cargo = $_POST['cargo'],
                @$cedula = $_POST['cin'],
                @$departament = $_POST['adscrito'],
                @$unidad = $_POST['unidad'],
                @$estado = $_POST['ubicacion'],
                @$fechaingre = $_POST['fechaingreso'],
                @$tiempo = $_POST['organismos'],
                @$totaltiem = $_POST['tiempototal'],
                @$periodo = $_POST['periodo'],
                @$habiles = $_POST['habiles'],
                @$cantidad = $_POST['cantidad'],
                @$incorporacion = $_POST['incorporacion'],
            ];

            $paraquien = $_POST['cin'];

            $nombres = [
                'codigo',
                'fecha',
                'codigo nomina',
                'nombre',
                'cargo',
                'cedula',
                'departamento',
                'adscrito',
                'ubicacion',
                'fecha de ingreso',
                'tiempo de servicio en otros organismos publicos',
                'total de tiempo en la administracion publica',
                'periodo vacacional',
                'dias habiles a disfrutar',
                'cantidad de dias',
                'fecha de incorporacion',
            ];

            $a = 0;
            foreach ($nombres as $key) {
                $array[$key] = $data[$a];
                $a++;
            }

            $siu = Solicitud::crearSolicitud(Solicitud::de_vacaciones, $array, $paraquien);
            break;
        case '4':
            $data = [
                $_POST['inputNames'],
                $_POST['ced'],
                $_POST['sociobioregion'],
                $_POST['estado'],
                $_POST['phone'],
                $_POST['celphonN'],
                $_POST['nombreBene'],
                $_POST['ciBene'],
                $_POST['parent'],
                $_POST['organismos'],
                $_POST['origen'],
                $_POST['fotocopia'],
                $_POST['diagnostico'],
                $_POST['observaciones'],
            ];

            $paraquien = $_POST['ced'];

            $nombres = [
                'nombre',
                'cedula',
                'sociobio-region',
                'estado',
                'telefono personal',
                'telefono de contacto con clinica',
                'nombre del beneficiario',
                'ci del beneficiario',
                'parentesco',
                'documentos a consignar',
                'origen de',
                'fotocopia de',
                'diagnostico',
                'observaciones',
            ];

            $a = 0;
            foreach ($nombres as $key) {
                $array[$key] = $data[$a];
                $a++;
            }

            $siu = Solicitud::crearSolicitud(Solicitud::de_carta_aval, $array, $paraquien);
            break;
        case '5':

            $data = [
                $_POST['codigo'],
                $_POST['fecha'],
                $_POST['codigoNomina'],
                $_POST['inputNames'],
                $_POST['cargo'],
                $_POST['cin'],
                $_POST['adscrito'],
                $_POST['unidad'],
                $_POST['ubicacion'],
                $_POST['fechaingreso'],
                $_POST['organismos'],
                $_POST['tiempototal'],
                $_POST['desde'],
                $_POST['hasta'],
                $_POST['cantidad'],
                $_POST['incorporacion'],
                $_POST['licencia'],
                $_POST['observaciones']
            ];

            $paraquien = $_POST['cin'];

            $nombres = [
                'codigo',
                'fecha',
                'codigo nomina',
                'nombre',
                'cargo',
                'cedula',
                'departamento',
                'unidad',
                'ubicacion',
                'fechaingreso',
                'tiempototal',
                'desde',
                'hasta',
                'incorporacion',
                'licencia',
                'observaciones',
            ];

            $a = 0;
            foreach ($nombres as $key) {
                $array[$key] = $data[$a];
                $a++;
            }

            $siu = Solicitud::crearSolicitud(Solicitud::de_licencia_paternidad, $array, $paraquien);
            break;

        default:
            ?>
            <script type="text/javascript">
                alert("Tipo de solicitud no valido");
                javascript: history.back();
            </script>
            <?php
            break;

    }

    if ($_POST['formtipo'] == 1 || $_POST['formtipo'] == 2 || $_POST['formtipo'] == 3 || $_POST['formtipo'] == 4 || $_POST['formtipo'] == 5) {
        $siu->cargar();
        $_SESSION["noti"] = 1;
        header('location: ../public/solicitudes.php');
    }

} else {
    ?>
    <script type="text/javascript">
        alert("Tipo de solicitud no valido");
        javascript: history.back();
    </script>
    <?php
}
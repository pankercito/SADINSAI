<?php

include "class/conx.php";
include "class/auditoria.php";
include "class/audiSolis.php";
include "function/criptCodes.php";
include "function/filesFunctions.php";
include "function/sumarhora.php";
include "class/solicitudes.php";

session_start();

$conn = new Conexion();

@$id = $conn->real_escape($_POST['idSoli']);

switch (@$_POST['tipoSoli']) {
    case 1:
        // CARTA DE AVAL
        $dta = Solicitud::obtenerSolicitud($id);

        $datospln = $dta->detallePLanillas();

        $nombres = [
            1 => 'codigo',
            2 => 'fecha',
            3 => 'codigoNomina',
            4 => 'inputNames',
            5 => 'cargo',
            6 => 'cin',
            7 => 'adscrito',
            8 => 'unidad',
            9 => 'ubicacion',
            10 => 'fechaingreso',
            11 => 'organismos',
            12 => 'tiempototal',
            13 => 'motivode',
            14 => 'observaciones'
        ];

        //array de titulos nombres para guardar
        $valores = [
            1 => 'codigo',
            2 => 'fecha',
            3 => 'codigo nomina',
            4 => 'nombre',
            5 => 'cargo',
            6 => 'cedula',
            7 => 'departamento',
            8 => 'unidad',
            9 => 'ubicacion',
            10 => 'fecha ingreso',
            11 => 'organismos',
            12 => 'tiempo total',
            13 => 'motivo de anticipo',
            14 => 'observaciones',
        ];

        foreach ($valores as $key => $value) {
            @$_SESSION[$nombres[$key]] = $datospln[0][$valores[$key]];
        }

        echo 1;

        break;
    case 2:
        // SOLICITUD DE PERMISO
        $dta = Solicitud::obtenerSolicitud($id);

        $datospln = $dta->detallePLanillas();

        $nombres = [
            'inputNames',
            'ced',
            'fecha',
            'fechaingreso',
            'cargo',
            'adscrito',
            'direccion',
            'diasH',
            'diasC',
            'inicio',
            'regreso',
            'causa',
        ];

        //array de titulos nombres para guardar
        $valores = [
            'nombre',
            'cedula',
            'fecha',
            'fecha de ingreso',
            'denominacion de cargo',
            'unidad de adscripcion',
            'direccion / oficina',
            'dias habiles',
            'dias continuos',
            'fecha de inicio',
            'fecha de regreso',
            'causa',
        ];

        foreach ($valores as $key => $value) {
            @$_SESSION[$nombres[$key]] = $datospln[0][$valores[$key]];
        }
        echo 2;

        break;
    case 3:
        $dta = Solicitud::obtenerSolicitud($id);

        $datospln = $dta->detallePLanillas();

        $nombres = [
            'codigo',
            'fecha',
            'codigoNomina',
            'inputNames',
            'cargo',
            'cin',
            'adscrito',
            'unidad',
            'ubicacion',
            'fechaingreso',
            'organismos',
            'tiempototal',
            'periodo',
            'habiles',
            'cantidad',
            'incorporacion'
        ];


        $valores = [
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
            'fecha de incorporacion'
        ];

        foreach ($valores as $key => $value) {
            @$_SESSION[$nombres[$key]] = $datospln[0][$valores[$key]];
        }

        echo 3;
        break;
    case 4:
        $dta = Solicitud::obtenerSolicitud($id);

        $datospln = $dta->detallePLanillas();

        $nombres = [
            'inputNames',
            'ced',
            'socibioregion',
            'estado',
            'phone',
            'celphonN',
            'nombreBene',
            'ciBene',
            'parent',
            'organismos',
            'origen',
            'fotocopia',
            'diagnostico',
            'observaciones',
        ];

        $valores = [
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

        foreach ($valores as $key => $value) {
            @$_SESSION[$nombres[$key]] = $datospln[0][$valores[$key]];
        }

        echo 4;
        break;
    case 5:
        $dta = Solicitud::obtenerSolicitud($id);

        $datospln = $dta->detallePLanillas();

        $nombres = [
            'codigo',
            'fecha',
            'codigoNomina',
            'inputNames',
            'cargo',
            'cin',
            'adscrito',
            'unidad',
            'ubicacion',
            'fechaingreso',
            'organismos',
            'tiempototal',
            'desde',
            'hasta',
            'cantidad',
            'incorporacion',
            'licencia',
            'observaciones'
        ];

        $valores = [
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

        foreach ($valores as $key => $value) {
            @$_SESSION[$nombres[$key]] = $datospln[0][$valores[$key]];
        }

        echo 5;
        break;
    default:
        break;
}
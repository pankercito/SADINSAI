<?php

include "conx.php";
include "function/criptCodes.php";
include "function/filesFunctions.php";
include "function/sumarhora.php";
include "class/solicitudes.php";

session_start();

$conn = new Conexion();

@$id = $conn->real_escape($_POST['idSoli']);

switch (@$_POST['tipoSoli']) {
    case 1:
        $dta = solicitudes::obtenersolicitud($id);

        $datospln = $dta->DetallePLanillas();

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
            $_SESSION[$nombres[$key]] = $datospln[0][$valores[$key]];
        }

        echo 1;

        break;

    case 2:
        echo 2;
        break;

    case 3:
        $dta = solicitudes::obtenersolicitud($id);

        $datospln = $dta->DetallePLanillas();

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
            13 => 'periodo',
            14 => 'habiles',
            15 => 'cantidad',
            16 => 'incorporacion'
        ];


        $valores = [
            1 => 'codigo',
            2 => 'fecha',
            3 => 'codigo nomina',
            4 => 'nombre',
            5 => 'cargo',
            6 => 'cedula',
            7 => 'departamento',
            8 => 'adscrito',
            9 => 'ubicacion',
            10 => 'fecha de ingreso',
            11 => 'tiempo de servicio en otros organismos publicos',
            12 => 'total de tiempo en la administracion publica',
            13 => 'periodo vacacional',
            14 => 'dias habiles a disfrutar',
            15 => 'cantidad de dias',
            16 => 'fecha de incorporacion'
        ];

        foreach ($valores as $key => $value) {
            $_SESSION[$nombres[$key]] = $datospln[0][$valores[$key]];
        }

        echo 3;
        break;

    case 4:
        $dta = solicitudes::obtenersolicitud($id);

        $datospln = $dta->DetallePLanillas();

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
            $_SESSION[$nombres[$key]] = $datospln[0][$valores[$key]];
        }

        echo 4;
        break;
    case 5:
        echo 5;
        break;
    default:
        break;
}
<?php

include "conx.php";
include "function/criptCodes.php";
include "function/filesFunctions.php";
include "function/sumarhora.php";
include "class/solicitudes.php";

$conn = new Conexion();

@$id = $conn->real_escape($_POST['idSoli']);

switch (@$_POST['radio']) {
    case 1:
        $tn = Solicitud::ObtenerSolicitud($id);

        $no = $tn->aceptarSolicitud(); 

        if (@$no) {
            echo "solicitud aceptada correctamente";
        } else {
            echo "error al aceptar solicitud";
        }

        break;
    case 2:
        $motivo = $conn->real_escape($_POST['motivo']);

        if ($motivo) {
            $tn = Solicitud::ObtenerSolicitud($id);

            $no = $tn->rechazarSolicitud($motivo);

            if ($no) {
                echo "solicitud rechazada correctamente";
            } else {
                echo "error al aceptar solicitud";
            }
        } else {
            echo "error no hay motivo";
            break;
        }
        break;
    default:
        // Hacer algo en caso de que la variable no sea igual a ninguna de las opciones
        echo "error.personal.default";

        break;
}
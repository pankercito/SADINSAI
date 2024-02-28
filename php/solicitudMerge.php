<?php

if (isset($_POST['radio']) && isset($_POST['idSoli'])) {
    
    include "class/classIncludes.php";
    include "function/criptCodes.php";
    include "function/filesFunctions.php";
    include "function/sumarhora.php";

    $conn = new Conexion();
    
    $id = $conn->real_escape($_POST['idSoli']);

    $merge = new GestionData($id);

    //identificacion de tipo de solicitud
    switch ($_POST['tipo']) {

        case '0': // ingreso de personal
            switch ($_POST['radio']) {
                case 1:
                    // aceptar solicitud 
                    $add = $merge->addPersonal();

                    if (is_array($add)) {
                        echo json_encode($add);
                    } else {
                        echo "error.personal";
                        echo $add;
                    }
                    break;

                case 2:
                    // rechazar solicitud

                    $recha = $merge->rechazarSoli();

                    if ($recha == true) {
                        echo "succes.personal.rechazar";
                    } else {
                        echo "error.personal.rech.query";
                    }
                    break;
                default:
                    // Hacer algo en caso de que la variable no sea igual a ninguna de las opciones
                    echo "error.personal.default";
            }
            break;
        case '1': // edicion de personal
            switch ($_POST['radio']) {
                case 1:
                    // aceptar solicitud 
                    $edit = $merge->editPersonal();

                    if (is_array($edit)) {
                        echo json_encode($edit);
                    } else {
                        echo "error.personal.edit";
                    }
                    break;
                case 2:
                    // rechazar solicitud
                    $recha = $merge->rechazarSoli();

                    if ($recha == true) {
                        echo 'success.personal.edit.rechazar';
                    } else {
                        echo "error.edit.personal.nosoli";
                    }
                    break;
                default:
                    // Hacer algo en caso de que la variable no sea igual a ninguna de las opciones
                    echo "ha ocurrido un error por favor intente nuevamente";
            }
            break;
        case '2': // INGRESO DE ARCHIVO
            switch ($_POST['radio']) {
                case '1': // ACEPTAR SOLICITUD

                    $ingreso = $merge->addArchive();

                    if ($ingreso[0] == true) {
                        echo json_encode($ingreso);
                    } else {
                        echo "error.arch";
                        echo $ingreso[1];
                    }
                    break;

                case '2':
                    // rechazar solicitud
                    $recha = $merge->rechazarSoli();

                    if ($recha == true) {
                        echo 'success.archivo.ingreso';
                    } else {
                        echo "error.archivo.no.query";
                    }
                    break;
                default:
                    # code...
                    break;

            }
            break;
        case '3': //eliminacion de archivos
            switch ($_POST['radio']) {
                case '1': // ACEPTAR SOLICITUD

                    $change = $merge->deleteArchive();

                    if (is_array($change)) {
                        echo json_encode($change);
                    } else {
                        echo "error.arch.move<br> el archivo no existe o ya fue eliminado  ";
                    }
                    break;

                case '2':
                    // rechazar solicitud
                    $recha = $merge->rechazarSoli();

                    if ($recha == true) {
                        echo 'success.archivo.eliminar.rechazar';
                    } else {
                        echo "error.arch.eliminar.rechazar";
                    }
                    break;

                default:
                    # code...
                    break;
            }
            break;
        default:
            echo "error al procesar solicitud";
            break;
    }
} else {
    echo "tamos mal";
}
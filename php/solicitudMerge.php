<?php

if (isset($_POST['radio']) && isset($_POST['idSoli'])) {
    include('conx.php');
    include("function/criptCodes.php");
    include("function/filesFunctions.php");
    include("function/sumarhora.php");

    $conn = new Conexion();

    $id = $conn->real_escape($_POST['idSoli']);

    //identificacion de tipo de solicitud
    switch ($_POST['tipo']) {

        case '0': // ingreso de personal
            switch ($_POST['radio']) {
                case 1:
                    // aceptar solicitud 
                    $sql = $conn->query("SELECT * FROM solicitudes s INNER JOIN solicitudes_precarga p ON p.id_solicitud_precarga = s.id_solicitud WHERE s.id_solicitud = $id");

                    if ($sql == true) {

                        $dat = $sql->fetch_assoc();

                        $ci = $dat['ci_pre'];
                        $nombre = $dat['nombre_pre'];
                        $apellido = $dat['apelido_pre'];
                        $grado = $dat['grado_ac_pre'];
                        $fecha = $dat['fecha_nac_pre'];
                        $sexo = $dat['sexo_pre'];
                        $estado = $dat['id_estado_pre'];
                        $ciudad = $dat['id_ciudad_pre'];
                        $sede = $dat['id_sede_pre'];
                        $dirr = $dat['direccion_pre'];
                        $mail = $dat['email_pre'];
                        $celp = $dat['telefono_pre'];
                        $cargo = $dat['cargo_pre'];


                        $sql1 = $conn->query("INSERT INTO personal (ci, nombre,apellido, grado_ac, fecha_nac, sexo, id_estado, id_ciudad ,sede_id,direccion, email, telefono, cargo)
                                                 VALUES ('$ci', '$nombre', '$apellido', '$grado', '$fecha', '$sexo', '$estado', '$ciudad', '$sede', '$dirr', '$mail', '$celp',' $cargo')");
                        if ($sql1 != true) {
                            echo "error.personal";
                        } else {
                            $sql2 = $conn->query("UPDATE solicitudes SET apr_estado = '1' WHERE id_solicitud = '$id'");
                            $location[] = [
                                'redirec' => 'perfil.php?perfil=' . encriptar($dat['ci_pre']) . '&parce=true',
                                'estado' => 'succes.personal.ingres'
                            ];
                            echo json_encode($location);
                        }
                    } else {
                        echo "error.personal";
                    }
                    break;

                case 2:
                    // rechazar solicitud
                    $query = $conn->query("SELECT * FROM solicitudes WHERE id_solicitud = '$id'");

                    if ($query == true) {
                        $sql1 = $conn->query("UPDATE solicitudes SET apr_estado = '2' WHERE id_solicitud = '$id'");

                        if ($sql1 == true) {
                            echo "succes.personal.rechazar";
                        } else {
                            echo "error.personal.rech.query";
                        }
                    } else {
                        echo "error.personal.no.soli";
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
                    $sql = $conn->query("SELECT * FROM solicitudes s INNER JOIN solicitudes_precarga p ON p.id_solicitud_precarga = s.id_solicitud WHERE s.id_solicitud = $id");

                    if ($sql == true) {

                        $dat = $sql->fetch_assoc();

                        $sql1 = $conn->query("UPDATE personal SET nombre = '{$dat['nombre_pre']}', 
                                                                  apellido = '{$dat['apelido_pre']}',
                                                                  grado_ac = '{$dat['grado_ac_pre']}',
                                                                  fecha_nac = '{$dat['fecha_nac_pre']}',
                                                                  sexo = '{$dat['sexo_pre']}',
                                                                  id_estado = '{$dat['id_estado_pre']}', 
                                                                  id_ciudad = '{$dat['id_ciudad_pre']}', 
                                                                  sede_id = '{$dat['id_sede_pre']}', 
                                                                  direccion = '{$dat['direccion_pre']}', 
                                                                  email = '{$dat['email_pre']}',
                                                                  telefono = '{$dat['telefono_pre']}',
                                                                  cargo = '{$dat['cargo_pre']}'
                                                                  WHERE ci = '{$dat['ci_solicitada']}'");
                        if ($sql1 == false) {
                            echo "error.editper";
                        } else {
                            $sql2 = $conn->query("UPDATE solicitudes SET apr_estado = '1' WHERE id_solicitud = '$id'");

                            $location[] = [
                                'redirec' => 'perfil.php?perfil=' . encriptar($dat['ci_solicitada']) . '&parce=true',
                                'estado' => 'succes.personal.edit'
                            ];
                            echo json_encode($location);
                        }
                    } else {
                        echo "error.personal.edit";
                    }
                    break;
                case 2:
                    // rechazar solicitud
                    $query = $conn->query("SELECT * FROM solicitudes WHERE id_solicitud = '$id'");

                    if ($query == true) {

                        $sql1 = $conn->query("UPDATE solicitudes SET apr_estado = '2' WHERE id_solicitud = '$id'");

                        if ($sql1 == false) {
                            echo "error.edit.personal.";
                        } else {
                            echo 'success.personal.edit.rechazar';
                        }
                    } else {
                        echo "error.edit.personal.nosoli";
                    }
                    break;
                default:
                    // Hacer algo en caso de que la variable no sea igual a ninguna de las opciones
                    echo "ha ocurrido un error por favor intente nuevamente";
            }
            break;
        case '2': //ingreso de archivos
            switch ($_POST['radio']) {
                case '1': // ACEPTAR SOLICITUD
                    $subId = $conn->real_escape($_POST["idSoli"]);

                    $svp = $conn->query("SELECT * FROM solicitudes s INNER JOIN solicitudes_archivos_precarga p ON p.id_solicitud_archivo_pre = s.id_solicitud WHERE s.id_solicitud = '$subId'");
                    $sv = $svp->num_rows;

                    if ($sv == 1) {
                        $precarInf = $svp->fetch_assoc();

                        $id = $precarInf['id_solicitud_archivo_pre'];
                        $ci = $precarInf['ci_arch_pre'];
                        $dire = $precarInf['d_archivo_pre'];
                        $note = $precarInf['nombre_archivo_pre'];
                        $taken = $precarInf['nota_pre'];
                        $size = $precarInf['size_pre'];
                        $tipo = $precarInf['tipo_pre'];

                        $sql = $conn->query("INSERT INTO archidata (id_archivo, ci_arch, d_archivo, nombre_arch, nota, size, tipo_arch, ubicacion_fis, responsable, delete_arch) 
                                                            VALUES ('$id', '$ci', '$dire', '$note', '$taken', '$size', '$tipo', 2, 0, 0)");

                        if ($sql == true) {
                            $sql2 = $conn->query("UPDATE solicitudes SET apr_estado = '1' WHERE id_solicitud = '$id'");

                            $location[] = [
                                'redirec' => 'perfil.php?perfil=' . encriptar($precarInf['ci_arch_pre']) . '&parce=true',
                                'estado' => 'succes.arch.ingres'
                            ];
                            echo json_encode($location);

                        } else {
                            echo "error.arch";
                        }

                    } else {
                        echo "error.arch";
                    }

                    break;

                case '2':
                    // rechazar solicitud

                    $subId = $conn->real_escape($_POST["idSoli"]);

                    $query = $conn->query("SELECT * FROM solicitudes WHERE id_solicitud = '$subId'");

                    if ($query == true) {
                        $sql1 = $conn->query("UPDATE solicitudes SET apr_estado = '2' WHERE id_solicitud = '$subId'");

                        if ($sql1 == true) {
                            echo 'success.archivo.ingreso';
                        } else {
                            echo "error.archivo.dead";
                        }
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

            @$x = $conn->query("SELECT * FROM solicitudes_eliminacion_arch WHERE id_solicitud_eliminacion = '$id'");

            $idArch = $x->fetch_object()->id_archivo_eliminar;

            $verifi = $conn->query("SELECT * FROM archidata WHERE id_archivo = $idArch");

            if ($verifi->num_rows == 1) {
                switch ($_POST['radio']) {
                    case '1': // ACEPTAR SOLICITUD

                        // Obtener la ruta de la carpeta
                        $destino = '../trash';

                        if (!file_exists($destino)) {
                            mkdir($destino, 0777, true);
                        }

                        $id_arch = $verifi->fetch_object()->id_archivo;

                        $svp = $conn->query("SELECT * FROM archidata WHERE id_archivo = '$id_arch'");
                        $arch = $svp->fetch_object();

                        $archivo = $arch->d_archivo;
                        $nombreArch = $arch->nombre_arch;

                        // Mover archivos E Inyeccion
                        if (moveFile($archivo, $destino, $nombreArch) == true) { //mover archivos a la ruta espesifica
                            // Variables de archivos
                            $newDir = $destino . "/" . $nombreArch;

                            $change = $conn->query("UPDATE archidata SET d_archivo = $newDir WHERE id_archivo = '$id_arch'");

                            if ($change == true) {

                                $sql2 = $conn->query("UPDATE solicitudes SET apr_estado = '1' WHERE id_solicitud = '$id'");

                                $location[] = [
                                    'redirec' => 'perfil.php?perfil=' . encriptar($arch->ci_arch) . '&parce=true',
                                    'estado' => 'succes.arch.move'
                                ];

                                echo json_encode($location);
                            } else {
                                echo "error.arch.solit.change";
                            }
                        } else {
                            echo "error.arch.move";
                        }
                        break;

                    case '2':
                        // rechazar solicitud

                        $subId = $conn->real_escape($_POST["idSoli"]);

                        $query = $conn->query("SELECT * FROM solicitudes WHERE id_solicitud = '$subId'");

                        if ($query == true) {

                            $sql1 = $conn->query("UPDATE solicitudes SET apr_estado = '2' WHERE id_solicitud = '$subId'");

                            if ($sql1 == true) {
                                echo 'success.archivo.eliminar.rechazar';
                            } else {
                                echo "error.arch.2";
                            }
                        } else {
                            echo "error.arch.3";
                        }
                        break;

                    default:
                        # code...
                        break;
                }
            } else {

                $sql1 = $conn->query("UPDATE solicitudes SET apr_estado = '2' WHERE id_solicitud = '$id'");

                if ($sql1 == true) {
                    echo "error.arch.reload";
                } else {
                    echo 'el archivo no existe o ya fue eliminado';
                }
            }

            break;
        default:
            echo "error al procesar solicitud";
            break;
    }
} else {
    echo "tamos mal";
}
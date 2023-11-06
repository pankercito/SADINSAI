<?php

include "conx.php";
include "function/idGenerador.php";
include "function/criptCodes.php";
include "function/filesFunctions.php";
include "function/asignarSolicitud.php";
include "function/removerAcentos.php";
include "function/sumarHora.php";

$conn = new Conexion;

session_start();

$tipo = $conn->real_escape($_POST['tipo']);

switch ($tipo) {
    // ingreso de personal
    case 0:

        $IdEm = $conn->real_escape($_SESSION['sesion']);

        //precarga
        $ciRec = $conn->real_escape($_POST['ci']);
        $taken = $conn->real_escape(strtoupper(cor_acentos($_POST['name'])));
        $apellido = $conn->real_escape(strtoupper(cor_acentos($_POST['apellido'])));
        $grado = $conn->real_escape(strtoupper(cor_acentos($_POST['grado_academico'])));
        $sexo = $conn->real_escape(strtoupper(cor_acentos($_POST['sexo'])));
        $fecha = $conn->real_escape($_POST['naci']);
        $email = $conn->real_escape(strtoupper(cor_acentos($_POST['email'])));
        $direccion = $conn->real_escape(strtoupper(cor_acentos($_POST['direccion'])));
        $phone = $conn->real_escape($_POST['telefono']);
        $estado = $_POST['estado'];
        $ciudad = $_POST['ciudad'];
        $sede = $_POST['sede'];
        $cargo = $conn->real_escape($_POST['cargo']);
        $departament = $conn->real_escape($_POST['departament']);

        if ($_POST["name"] != "") {

            do {
                $id_solicitud = generarId();

                $sql = $conn->query("SELECT id_solicitud FROM solicitudes WHERE id_solicitud = '$id_solicitud'");
                $dan = mysqli_num_rows($sql);

            } while ($dan != 0);

            $fech = hora();

            $sqlsoli = $conn->query("INSERT INTO solicitudes (id_solicitud, id_emisor, ci_solicitada,  fecha, apr_estado, tipo) 
                                        VALUES ('$id_solicitud', '$IdEm', '$ciRec', '$fech', '0', 0)");

            $correr = $conn->query("INSERT INTO solicitudes_precarga (id_solicitud_precarga, ci_pre, nombre_pre, apelido_pre, grado_ac_pre, fecha_nac_pre, sexo_pre, id_estado_pre, id_ciudad_pre, id_sede_pre, direccion_pre, email_pre, telefono_pre, cargo_pre, departamento_pre) 
                                                            VALUES ('$id_solicitud', '$ciRec','$taken','$apellido', '$grado ', '$fecha', '$sexo', '$estado', '$ciudad', '$sede', '$direccion', '$email', '$phone', '$cargo', $departament)");

            if ($sqlsoli == true && $correr == true) {
                $_SESSION["editCI"] = 0;
                $_SESSION["noti"] = 1;
                header('location: ../public/gestionData.php');
            } else {
                @$conn->query("DELETE FROM `solicitudes` WHERE id_solicitud = $id_solicitud;");
                echo "Error al registrar el GUID: " . $ciRec;
            }

        } else {
            echo "<script type='text/javascript'>alert('error no llego')</script>";
        }
        break;

    // edicion de archivos de $personal
    case 1:

        $IdEm = $conn->real_escape($_SESSION['sesion']);

        // CI de editado
        $ciRec = $conn->real_escape($_SESSION['editCI']);

        //precarga
        $taken = $conn->real_escape(strtoupper(cor_acentos($_POST['name'])));
        $apellido = $conn->real_escape(strtoupper(cor_acentos($_POST['apellido'])));
        $grado = trim($conn->real_escape(strtoupper(cor_acentos($_POST['grado_academico']))));
        $sexo = $conn->real_escape(strtoupper(cor_acentos($_POST['sexo'])));
        $fecha = $conn->real_escape($_POST['edad']);
        $email = $conn->real_escape(strtoupper(cor_acentos($_POST['email'])));
        $direccion = $conn->real_escape(strtoupper(cor_acentos($_POST['direccion'])));
        $phone = $conn->real_escape($_POST['telefono']);
        $estado = $_POST['estado'];
        $ciudad = $_POST['ciudad'];
        $sede = $_POST['sede'];
        $cargo = $conn->real_escape($_POST['cargo']);
        $departament = $conn->real_escape($_POST['departament']);

        if ($_POST["name"] != "") {

            do {
                $id_solicitud = generarId();

                $sql = $conn->query("SELECT id_solicitud FROM solicitudes WHERE id_solicitud = '$id_solicitud'");
                $dan = mysqli_num_rows($sql);

            } while ($dan != 0);

            $fech = hora();

            $sqlsoli = $conn->query("INSERT INTO solicitudes (id_solicitud, id_emisor, ci_solicitada,  fecha, apr_estado, tipo) 
                                        VALUES ('$id_solicitud', '$IdEm', '$ciRec', '$fech', '0', 1)");

            $correr = $conn->query("INSERT INTO solicitudes_precarga (id_solicitud_precarga, ci_pre, nombre_pre, apelido_pre, grado_ac_pre, fecha_nac_pre, sexo_pre, id_estado_pre, id_ciudad_pre, id_sede_pre, direccion_pre, email_pre, telefono_pre, cargo_pre, departamento_pre) 
                                                            VALUES ('$id_solicitud', '$ciRec','$taken','$apellido', '$grado ', '$fecha', '$sexo', '$estado', '$ciudad', '$sede', '$direccion', '$email', '$phone', '$cargo', '$departament')");

            if (isset($sqlsoli) && isset($correr)) {
                $_SESSION["editCI"] = 0;
                $_SESSION["noti"] = 1;
                header('location: ../public/gestionData.php');
            } else {
                @$conn->query("DELETE FROM `solicitudes` WHERE id_solicitud = $id_solicitud;");
                echo "Error al registrar el GUID: " . $ciRec;
            }

        } else {
            echo "<script type='text/javascript'>alert('error no llego')</script>";
        }

        break;
    case 2:
        // ingreso de archivo
        $IdEm = $conn->real_escape($_SESSION['sesion']);

        // ingreso de documento 
        $taken = $conn->real_escape($_POST["nameArchive"]);
        $tipeArch = $conn->real_escape($_POST["gestionArch"]);
        $ci = $conn->real_escape(desencriptar($_POST["ciArch"]));
        $note = $conn->real_escape(cor_acentos($_POST["textArchive"]));
        $carion = $_FILES["inpArch"]["name"];
        $arch = $_FILES["inpArch"]["tmp_name"];

        // Obtener la ruta de la carpeta
        $folDestino = '../data/archives/' . $tipeArch;

        do {
            $id_solicitud = generarId();

            $sql = $conn->query("SELECT id_solicitud FROM solicitudes WHERE id_solicitud = '$id_solicitud'");
            $dan = mysqli_num_rows($sql);

        } while ($dan != 0);

        // nombre de archivo
        $nombreArch = ($taken == "") ? $id_solicitud . "=" . $carion : $id_solicitud . "=" . $taken;

        // Mover archivos E Inyeccion
        if (moveFile($arch, $folDestino, $nombreArch) == true) { //mover archivos a la ruta espesifica
            // Variables de archivos

            $idUserAg = $_SESSION['sesion'];
            $size = $_FILES["inpArch"]["size"];
            $fech = hora();
            $direccion = $folDestino . "/" . $nombreArch;

            // Inyección a BD
            @$sqlsoli = $conn->query("INSERT INTO solicitudes (id_solicitud, id_emisor, ci_solicitada,  fecha, apr_estado, tipo) 
                                        VALUES ('$id_solicitud', '$IdEm', '$ci', '$fech', '0', '2')");

            // Inyección a BD
            @$sql = $conn->query("INSERT INTO solicitudes_archivos_precarga (id_solicitud_archivo_pre, ci_arch_pre, d_archivo_pre, nombre_archivo_pre, nota_pre, size_pre, tipo_pre) 
            VALUES ('$id_solicitud', '$ci', '$direccion', '$taken', '$note', '$size', '$tipeArch')");

            if ($sqlsoli == true) {
                if ($sql == true) {
                    $_SESSION["noti"] = 1;
                    echo "success";
                } else {
                    @$conn->query("DELETE FROM `solicitudes` WHERE id_solicitud = $id_solicitud;");
                    echo "error";
                }
            } else {
                echo "error";
            }
        } else {
            echo "error";
        }
        break;
    case 3:
        // eliminacion de archivo 
        if (isset($_POST['archivo'])) {

            $IdEm = $conn->real_escape($_SESSION['sesion']);

            // id de archivo
            $archivo = $conn->real_escape($_POST['archivo']);

            // datos del archivo
            $arch = $conn->query("SELECT * FROM archidata WHERE id_archivo = '$archivo'");

            if ($arch->num_rows == 1) {

                $data = $arch->fetch_object();

                $ci = $data->ci_arch;

                // generarId
                do {
                    $id_solicitud = generarId();

                    $sql = $conn->query("SELECT id_solicitud FROM solicitudes WHERE id_solicitud = '$id_solicitud'");
                    $dan = mysqli_num_rows($sql);

                } while ($dan != 0);

                $fech = hora();

                @$sqlsoli = $conn->query("INSERT INTO solicitudes (id_solicitud, id_emisor, ci_solicitada,  fecha, apr_estado, tipo) 
                                            VALUES ('$id_solicitud', '$IdEm', '$ci', '$fech', '0', 3)");

                if ($sqlsoli == true) {
                    // tabla delete soli 
                    @$delete = $conn->query("INSERT INTO solicitudes_eliminacion_arch (id_solicitud_eliminacion, id_archivo_eliminar) 
                                            VALUES ( '$id_solicitud' ,'$archivo')");

                    if ($delete == true) {
                        $_SESSION["editCI"] = 0;
                        $_SESSION["noti"] = 1;

                        $location[] = [
                            'redirec' => 'gestionData.php',
                            'estado' => 'succes.delete'
                        ];

                        echo json_encode($location);
                    } else {
                        echo "error";
                    }
                } else {
                    echo "error.delete";
                }
            } else {
                echo "no data";
            }
        } else {
            echo "error.delete";
        }
        break;
    default:
        echo "no agregado";
        break;
}

$conn->close();
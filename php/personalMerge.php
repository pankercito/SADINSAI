<?php

if (isset($_POST['radio']) && isset($_POST['idSoli'])) {
    include('conx.php');
    include("function/criptCodes.php");
    $conn = new Conexion();

    $ci = $conn->real_escape($_POST['idSoli']);

    switch ($_POST['radio']) {
        case 1:
            // aceptar solicitud 
            $sql = $conn->query("SELECT * FROM precarga p INNER JOIN solicitudes s ON p.id_solicitud = s.id_solicitud WHERE p.id_solicitud = $ci");
            if (!$sql && $num = mysqli_num_rows($sql) > 0) {
                echo "error en leer la solicitud por favor intente mas tarde";
            } else {
                $dat = mysqli_fetch_array($sql);

                $sql1 = $conn->query("UPDATE personal SET nombre = '{$dat['name']}', 
                                             apellido = '{$dat['apelido']}', 
                                             id_estado = '{$dat['id_estado']}', 
                                             id_ciudad = '{$dat['id_ciudad']}', 
                                             sede_id = '{$dat['sede_id']}', 
                                             direccion = '{$dat['direccion']}', 
                                             email = '{$dat['email']}',
                                             telefono = '{$dat['telefono']}',
                                             cargo = '{$dat['cargo']}'
                        WHERE ci = '{$dat['ci_solicitada']}'");



                if (!$sql1) {
                    echo "error en leer la solicitud por favor intente mas tarde";
                } else {
                    $sql2 = $conn->query("UPDATE solicitudes SET apr_estado = '1' WHERE id_solicitud = '$ci'");

                    echo 'perfil.php?perfil=' . encriptar($dat['ci_solicitada']);
                }
            }
            break;

        case 2:
            // rechazar solicitud
            $query = $conn->query("SELECT * FROM solicitudes WHERE id_solicitud = '$ci'");

            $num = mysqli_num_rows($query);

            if (!$query) {
                echo "error al rechazar por favor intente mas tarde" . mysqli_error($connec);
            } else {
                $sql1 = $conn->query("UPDATE solicitudes SET apr_estado = '2' WHERE id_solicitud = '$ci'");

                if (!$sql1) {
                    echo "error";
                } else {
                    echo 'success-delimit';
                }
            }
            break;
        default:
            // Hacer algo en caso de que la variable no sea igual a ninguna de las opciones
            echo "ha ocurrido un error por favor intente nuevamente";
    }
} else {
    echo json_encode("taoms mal mi loco");
}
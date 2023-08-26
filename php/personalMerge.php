<?php

if (isset($_POST['radio']) && isset($_POST['idSoli'])){
    include ('conx.php');
    include ("function/criptCodes.php");
    
    $ci = mysqli_real_escape_string($conn, $_POST['idSoli']);
    
    switch ($_POST['radio']) {
        case 1:
            // aceptar solicitud 
            $sql = "SELECT * FROM precarga p INNER JOIN solicitudes s ON p.id_solicitud = s.id_solicitud WHERE p.id_solicitud = $ci";

            $query = mysqli_query($conn, $sql);
            $num = mysqli_num_rows($query);

            // DATOS DE PRECARGA 
            $dat = mysqli_fetch_array($query);

            if (!$query && $num > 0) {
                echo "error en leer la solicitud por favor intente mas tarde" . mysqli_error($connec);
            } else{
                
                $sql1 = "UPDATE personal SET nombre = '{$dat['name']}', 
                                             apellido = '{$dat['apelido']}', 
                                             id_estado = '{$dat['id_estado']}', 
                                             id_ciudad = '{$dat['id_ciudad']}', 
                                             sede_id = '{$dat['sede_id']}', 
                                             direccion = '{$dat['direccion']}', 
                                             email = '{$dat['email']}',
                                             telefono = '{$dat['telefono']}',
                                             cargo = '{$dat['cargo']}'
                        WHERE ci = '{$dat['ci_solicitada']}'";

                
                
                if (!mysqli_query($conn, $sql1)) {
                    echo "error en leer la solicitud por favor intente mas tarde" . mysqli_error($conn);
                } else{
                    $sql2 = "UPDATE solicitudes SET apr_estado = '1' WHERE id_solicitud = '$ci'";
                    $query2 = mysqli_query($conn, $sql2);
                    
                    echo 'principal.php?perfil='. encriptar($dat['ci_solicitada']);  
                }
            }
            $connec->close();
            break;

        case 2:
            // rechazar solicitud
            $sql = "SELECT * FROM solicitudes WHERE id_solicitud = '$ci'";
            
            $query = mysqli_query($connec, $sql);
            $num = mysqli_num_rows($query);
            
            if (!$query) {
                echo "error al rechazar por favor intente mas tarde" . mysqli_error($connec);
            } else{
                $sql1 = "UPDATE solicitudes SET apr_estado = '2' WHERE id_solicitud = '$ci'";
                $query1 = mysqli_query($connec, $sql1);
            }
            $connec->close();
            echo 'success-delimit';
            
            break;
            
        default:
          // Hacer algo en caso de que la variable no sea igual a ninguna de las opciones
          echo "ha ocurrido un error por favor intente nuevamente";
    }
} else {
    echo json_encode("taoms mal mi loco");
}






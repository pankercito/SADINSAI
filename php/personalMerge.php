<?php

if (isset($_POST['radio']) && isset($_POST['idSoli'])){
    include ('conect.php');
    include ("funtion/encriptDesencript.php");
    
    $id = mysqli_real_escape_string($connec, $_POST['idSoli']);
    
    switch ($_POST['radio']) {
        case 1:
            // aceptar solicitud 
            $sql = "SELECT * FROM precarga p INNER JOIN solicitudes s ON p.id_solicitud = s.id_solicitud WHERE p.id_solicitud = $id";

            $query = mysqli_query($connec, $sql);
            $num = mysqli_num_rows($query);

            // DATOS DE PRECARGA 
            $dat = mysqli_fetch_array($query);

            if (!$query && $num > 0) {
                echo "error en leer la solicitud por favor intente mas tarded" . mysqli_error($connec);
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

                $query1 = mysqli_query($connec, $sql1);
                
                if (!$query1) {
                    echo "error en leer la solicitud por favor intente mas tarde" . mysqli_error($connec);
                } else{
                    $sql2 = "UPDATE solicitudes SET apr_estado = '1' WHERE id_solicitud = '$id'";
                    $query2 = mysqli_query($connec, $sql2);
                    
                    echo 'principal.php?perfil='. encriptar($dat['ci']);  
                }
            }
            $connec->close();
            break;

        case 2:
            // rechazar solicitud
            $sql = "SELECT * FROM solicitudes WHERE id_solicitud = '$id'";
            
            $query = mysqli_query($connec, $sql);
            $num = mysqli_num_rows($query);
            
            if (!$query) {
                echo "error al rechazar por favor intente mas tarde" . mysqli_error($connec);
            } else{
                $sql1 = "UPDATE solicitudes SET apr_estado = '2' WHERE id_solicitud = '$id'";
                $query1 = mysqli_query($connec, $sql1);
            }
            $connec->close();
            echo '<h6>Se ha rechazado la solicitud correctamente</h6>';
            
            break;
            
        default:
          // Hacer algo en caso de que la variable no sea igual a ninguna de las opciones
          echo "ha ocurrido un error por favor intente nuevamente";
    }
} else {
    echo json_encode("taoms mal mi loco");
}






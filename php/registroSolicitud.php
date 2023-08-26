<?php

include("conx.php");
include("function/idGenerador.php");
include("function/asignarSolicitud.php");
include("function/removerAcentos.php");

session_start();
//soli
$ciEm = $_SESSION['cidelusuario'];
$recep = asignar();
$ciRec = $_SESSION['editCI'];
$ci = mysqli_real_escape_string($connec, $_POST["ci"]);

//precarga
$taken=  mysqli_real_escape_string($connec, strtoupper(remover_acentos($_POST['name'])));
$apellido= mysqli_real_escape_string($connec, strtoupper(remover_acentos($_POST['apellido'])));
$email = mysqli_real_escape_string($connec, strtoupper(remover_acentos($_POST['email'])));
$direccion = mysqli_real_escape_string($connec, strtoupper(remover_acentos($_POST['direccion'])));
$phone = mysqli_real_escape_string($connec, $_POST['telefono']);
$estado = $_POST['estado'];
$ciudad = $_POST['ciudad'];
$sede = $_POST['sede'];

if($_POST["ci"] !== ""){

    date_default_timezone_set('America/Caracas');
    $datetime = date('Y-m-d H:i:s');
    
    do {
        $id_solicitud = generarId();

        $sql = mysqli_query($connec,"SELECT id_solicitud FROM solicitudes WHERE id_solicitud = '$id_solicitud'");
        $dan = mysqli_num_rows($sql);

    } while ($dan != 0);

    $correr = mysqli_query($connec,"INSERT INTO precarga (id_solicitud, ci, name, apelido, id_estado, id_ciudad, sede_id, direccion, email, telefono) 
    VALUES ('$id_solicitud', '$ci','$taken','$apellido', '$estado', '$ciudad', '$sede', '$direccion', '$email', '$phone')");
    
    $sqlsoli = mysqli_query($connec,"INSERT INTO solicitudes (ci_emisor, id_receptor, ci_solicitada, id_solicitud, fecha, apr_estado) 
                                    VALUES ('$ciEm', '$recep', '$ciRec', '$id_solicitud', '$datetime', '0')");

    $connec->close();

    if (isset($sqlsoli) && isset($correr)) {
        $_SESSION["editCI"] = 0;
        $_SESSION["noti"] = 1;
        header('location: ../public/solicitudes.php');
    } else {
        echo "Error al registrar el GUID: " . $id_solicitud;
    }

}else{
    echo "<script type='text/javascript'>alert('error no llego')</script>";
}
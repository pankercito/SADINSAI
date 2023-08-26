<?php

include("conx.php");
include("function/idGenerador.php");
include("function/asignarSolicitud.php");
include("function/removerAcentos.php");

$conn = new Conexion;

session_start();
//soli
$ciEm = $conn->real_escape($_SESSION['cidelusuario']);
$recep = asignar();
print_r($recep);
$ciRec = $conn->real_escape($_SESSION['editCI']);

//precarga
$taken=  $conn->real_escape(strtoupper(remover_acentos($_POST['name'])));
$apellido=  $conn->real_escape(strtoupper(remover_acentos($_POST['apellido'])));
$email = $conn->real_escape(strtoupper(remover_acentos($_POST['email'])));
$direccion = $conn->real_escape(strtoupper(remover_acentos($_POST['direccion'])));
$phone = $conn->real_escape($_POST['telefono']);
$estado = $_POST['estado'];
$ciudad = $_POST['ciudad'];
$sede = $_POST['sede'];

if($_POST["name"] != ""){

    do {
        $id_solicitud = generarId();

        $sql =  $conn->query("SELECT id_solicitud FROM solicitudes WHERE id_solicitud = '$id_solicitud'");
        $dan = mysqli_num_rows($sql);

    } while ($dan != 0);

    $correr =  $conn->query("INSERT INTO precarga (id_solicitud, ci, name, apelido, id_estado, id_ciudad, sede_id, direccion, email, telefono) 
    VALUES ('$id_solicitud', '$ciRec','$taken','$apellido', '$estado', '$ciudad', '$sede', '$direccion', '$email', '$phone')");
    
    $sqlsoli =  $conn->query("INSERT INTO solicitudes (ci_emisor, id_receptor, ci_solicitada, id_solicitud, fecha, apr_estado) 
                                    VALUES ('$ciEm', '$recep', '$ciRec', '$id_solicitud', now(), '0')");

    if (isset($sqlsoli) && isset($correr)) {
        $_SESSION["editCI"] = 0;
        $_SESSION["noti"] = 1;
        header('location: ../public/solicitudes.php');
    } else {
        echo "Error al registrar el GUID: " . $ciRec;
    }

}else{
    echo "<script type='text/javascript'>alert('error no llego')</script>";
}
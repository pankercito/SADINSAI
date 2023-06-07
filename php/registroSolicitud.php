<?php

include("conect.php");
include("funtion/idGenerador.php");

session_start();

$ci = $_SESSION['cidelusuario'];

$ciSoli = mysqli_real_escape_string($connec, $_POST["sCi"]);
$tex = strtolower(mysqli_real_escape_string($connec, $_POST["sMotivo"]));

if(isset($_POST["sCi"])){

    date_default_timezone_set('America/Caracas');
    $datetime = date('Y-m-d H:i:s');
    
    do {
        $id_solicitud = generarId();

        $sql = mysqli_query($connec,"SELECT id_solicitud FROM solicitudes WHERE id_solicitud = '$id_solicitud'");
        $dan = mysqli_num_rows($sql);

    } while ($dan != 0);

    $sqlp = mysqli_query($connec,"INSERT INTO solicitudes (ci, ci_solicitada, id_solicitud, fecha, motivo, apr_estado) VALUES ('$ci', '$ciSoli', '$id_solicitud', '$datetime', '$tex', '0')");
    $connec->close();
    
    if (isset($sqlp)) {
        $_SESSION["noti"] = 1;
        header('location: ../public/solicitudes.php');
    } else {
        echo "Error al registrar el GUID: " . $id_solicitud;
    }

}
<?php

include('../php/conx.php');

if (isset($_POST["idArch"])) {

    include("../php/function/getESCname.php");
    include("../php/function/criptCodes.php");

    $conn = new Conexion();

    $id = $conn->real_escape($_POST['idArch']);

    $sql = $conn->query("SELECT * FROM archidata a 
                              INNER JOIN solicitudes s
                              INNER JOIN direccion_direcciones d
                              ON a.id_archivo = s.id_solicitud
                              AND d.id_direccion = a.ubicacion_fis
                              WHERE s.id_solicitud = '$id' ");

    $data = $sql->fetch_object();

    $UbicacionA = $data->dir_nombre;
    $responsable = ($data->responsable == "") ? $data->dir_nombre : $data->responsable;

}else {
    $UbicacionA = "error no data";
    $responsable = "error no data";
}
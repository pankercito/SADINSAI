<?php

include "../php/configIncludes.php";

if (isset($_POST["idArch"])) {

    $conn = new Conexion();

    $id = $conn->real_escape($_POST['idArch']);

    $sql = $conn->query("SELECT * FROM archidata a 
                              INNER JOIN solicitudes s
                              INNER JOIN departamentos d
                              ON a.id_archivo = s.id_solicitud
                              AND d.id_direccion = a.ubicacion_fis
                              WHERE s.id_solicitud = '$id' ");

    $data = $sql->fetch_object();

    $UbicacionA = $data->dir_nombre;

    $e = new Empleado(getUserHash(null, $data->responsable));

    $nombre = ucwords("$e->nombre $e->apellido | $e->ci");

    $responsable = ($data->responsable == '') ? $data->dir_nombre : $nombre;

}else {
    $UbicacionA = "error no data";
    $responsable = "error no data";
}
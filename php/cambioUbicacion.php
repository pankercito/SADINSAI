<?php

include "../php/configIncludes.php";

if (isset($_POST["idArch"])) {

    $conn = new Conexion();
    $aud = new GestionesAuditoria;

    $arch = $conn->real_escape($_POST["idArch"]);
    $res = $conn->real_escape(desencriptar($_POST["responsable"]));
    $dir = $conn->real_escape($_POST["ndireccion"]);

    @$d = $conn->query("SELECT * FROM `archidata` WHERE id_archivo = $arch");

    if ($aud->cambioDeUbicacionArchivo()) {
        if ($d->num_rows > 0) {

            @$u = $conn->query("UPDATE `archidata` SET responsable = '$res', ubicacion_fis = '$dir' WHERE id_archivo = $arch");

            if ($u == true) {
                echo "se cambio la ubicacion correctamente";
            } else {
                echo "error al cambiar la ubicacion";
            }

        } else {
            echo "error al leer la solicitud";
        }
    } else {
        echo "error al leer la solicitud";
    }
} else {
    echo "nollego";
}
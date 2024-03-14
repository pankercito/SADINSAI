<?php

$ci = desencriptar($_GET['c']);
$tipo = $conn->real_escape($_GET['g']);

$sql = $conn->query("SELECT * FROM archidata a 
                              INNER JOIN solicitudes s
                              INNER JOIN registro r
                              INNER JOIN departamentos d
                              ON a.id_archivo = s.id_solicitud
                              AND s.id_emisor = r.id_usuario
                              AND d.id_direccion = a.ubicacion_fis
                              WHERE a.tipo_arch = $tipo 
                              AND a.ci_arch = $ci
                              AND a.delete_arch = 0");

$count = mysqli_num_rows($sql);


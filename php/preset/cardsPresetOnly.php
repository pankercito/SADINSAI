<?php

include("../php/function/getUser.php");

$ci = desencriptar($_GET['carga']);
$tipo = $_GET['gestion'];

$sql = $conn->query("SELECT * FROM archidata a 
                              INNER JOIN solicitudes s
                              INNER JOIN registro r
                              ON a.id_archivo = s.id_solicitud
                              WHERE a.tipo_arch = $tipo 
                              AND a.ci_arch = $ci
                              AND s.id_emisor = r.id_usuario
                              ORDER BY s.fecha DESC");
                              
$count = mysqli_num_rows($sql);
$row = mysqli_fetch_assoc($sql);
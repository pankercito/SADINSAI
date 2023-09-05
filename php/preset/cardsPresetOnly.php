<?php

include("../php/function/getUser.php");

$ci = desencriptar($_GET['carga']);
$tipo = $_GET['gestion'];

$sql = $conn->query("SELECT * FROM archidata a 
                              INNER JOIN arch_direc d 
                              INNER JOIN registro r
                              ON d.id_arch = a.id_archivo 
                              WHERE d.id_tipo = $tipo 
                              AND a.ci_arch = $ci
                              AND d.Id_user_sub = r.id_usuario");

$count = mysqli_num_rows($sql);
$row = mysqli_fetch_assoc($sql);

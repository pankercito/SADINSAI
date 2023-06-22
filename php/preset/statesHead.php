<?php

include('../php/conect.php');

if(isset($_GET['onlystate'])){
    $stonly = $_GET['onlystate'];
    $sql = mysqli_query($connec,"SELECT * FROM estados WHERE id_estado = '$stonly'");

    $count_results = mysqli_num_rows($sql);

    while($row_searched = mysqli_fetch_array($sql)){
        $estados = array(
            $row_searched['id_estado'] => ucwords(strtolower($row_searched['estado']))
        );
    }
}
if(isset($_GET['onlysede'])){
    $sdonly = $_GET['onlysede'];
    $sql = mysqli_query($connec,"SELECT * FROM sedes WHERE sede_id = '$sdonly'");

    $count_results = mysqli_num_rows($sql);

    while($row_searched = mysqli_fetch_array($sql)){
        $sedes = array(
            $row_searched['sede_id'] => ucwords(strtolower($row_searched['nombre_sede']))
        );
    }
}
$connec->close();
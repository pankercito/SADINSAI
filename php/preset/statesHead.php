<?php

if(isset($_GET['onlystate'])){
    $stonly = $_GET['onlystate'];
    $sql = $conn->query("SELECT * FROM estados WHERE id_estado = '$stonly'");

    $count_results = mysqli_num_rows($sql);

    while($v = mysqli_fetch_array($sql)){
        $estados = array(
            $v['id_estado'] => ucwords(strtolower($v['estado']))
        );
    }
}

if(isset($_GET['onlysede'])){
    $sdonly = $_GET['onlysede'];
    $sql = $conn->query("SELECT * FROM sedes WHERE sede_id = '$sdonly'");

    $count_results = mysqli_num_rows($sql);

    while($v = mysqli_fetch_array($sql)){
        $sedes = array(
            $v['sede_id'] => ucwords(strtolower($v['nombre_sede']))
        );
    }
}
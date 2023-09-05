<?php

include("../php/function/getUser.php");
$conn = new Conexion();
$idP = $_SESSION['sesion'];


$regisview = $conn->query("SELECT * FROM solicitudes s INNER JOIN registro r ON r.id_usuario = s.id_receptor WHERE s.id_receptor = $idP ORDER BY fecha DESC");
$count_results = mysqli_num_rows($regisview);

//Si ha resultados
if ($count_results > 0) {
    //Muestra la cantidad de usuarios
    $apr = [
        "0" => "alert alert-secondary",
        "1" => "alert alert-success",
        "2" => "alert alert-danger",
    ];
    $aprN = [
        "0" => "pendiente",
        "1" => "aceptada",
        "2" => "rechasada",
    ];
    $aprL = [
        "0" => 'bi bi-person-lines-fill',
        "1" => 'bi bi-person-fill-check',
        "2" => 'bi bi-person-fill-x'
    ];

    while ($v = mysqli_fetch_array($regisview)) {
        //Lista de los usuarios
        echo '<tr data-solicitud="' . $v['id_solicitud'] . '" data-receptor="' . encriptar($v['ci_solicitada']) . '">';
        echo '<td><a>' . $v['id_solicitud'] . '</a></td>';
        echo '<td><a class="lol" href="perfil.php?perfil=' . encriptar($v['ci_emisor']) . '&parce=true">' . getUser('', encriptar($v['ci_emisor'])) . '</a></td>';
        echo '<td><a class="lol" href="perfil.php?perfil=' . encriptar($v['ci_solicitada']) . '&parce=true">' . $v['ci_solicitada'] . '</a></td>';
        echo '<td><a>' . $v['fecha'] . '</a></td>';
        echo '<td><a class="viewDetails btn btn"> Ver detalles </a></td>';

        $disabled = ($v['apr_estado'] != 0) ? "disabled" : "";

        echo '<td><a class="aprState ' . $apr[$v['apr_estado']] . '" ' . $disabled . '>' . $aprN[$v['apr_estado']] . '<span style="margin:.5rem;"></span><i class="' . $aprL[$v['apr_estado']] . '"></i></a></td>';
        echo '</tr>';
    }
} else {
    //Si no hay registros encontrados
    echo '<h2>no posee ninguna solicitud</h2>';
}
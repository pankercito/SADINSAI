<?php

include ("../php/conect.php");

$idP = $_SESSION['sesion'];

$regisview = mysqli_query($connec,"SELECT * FROM solicitudes s INNER JOIN registro r ON r.id_usuario = s.id_receptor WHERE s.id_receptor = $idP ORDER BY fecha DESC");
$count_results = mysqli_num_rows($regisview);

//Si ha resultados
if ($count_results > 0) {
    //Muestra la cantidad de usuarios
    $apr = array(
            "0" => "alert alert-secondary",
            "1" => "alert alert-success",
            "2" => "alert alert-danger",
    );
    $aprN = array(
        "0" => "pendiente",
        "1" => "aceptada",
        "2" => "rechasada",
    );
    $aprL = array(
        "0" => 'bi bi-person-lines-fill',
        "1" => 'bi bi-person-fill-check',
        "2" => 'bi bi-person-fill-x'
    );
    echo '<h6>total de solicitudes en espera '.$count_results.'.</h6>';

    while ($row_searched = mysqli_fetch_array($regisview)){
        //Lista de los usuarios
        echo '<tr data-solicitud="'.$row_searched['id_solicitud'].'" data-receptor="'.encriptar($row_searched['ci_solicitada']).'">';
        echo '<td><a>'.$row_searched['id_solicitud'].'</a></td>';
        echo '<td><a class="lol" href="principal.php?perfil='.encriptar($row_searched['ci']).'&parce=true">'.$row_searched['ci_emisor'].'</a></td>';
        echo '<td><a class="lol" href="principal.php?perfil='.encriptar($row_searched['ci_solicitada']).'&parce=true">'.$row_searched['ci_solicitada'].'</a></td>';
        echo '<td><a>'.$row_searched['fecha'].'</a></td>';
        echo '<td><a class="viewDetails btn btn"> Ver detalles </a></td>';

        if($row_searched['apr_estado'] != 0){
            $disabled = "disabled";
        }else{
            $disabled = "";
        }

        echo '<td><a class="aprState '.$apr[$row_searched['apr_estado']].'" '. $disabled .'>'.$aprN[$row_searched['apr_estado']].'<span style="margin:.5rem;"></span><i class="'.$aprL[$row_searched['apr_estado']].'"></i></a></td>';
        echo '</tr>';
    }
}else {
    //Si no hay registros encontrados
    echo '<h2>no posee ninguna solicitud</h2>';
}
$connec->close();
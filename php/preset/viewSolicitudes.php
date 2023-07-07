<?php

include ("../php/conect.php");

$ciP = $_SESSION['cidelusuario'];

$regisview = mysqli_query($connec,"SELECT * FROM solicitudes s INNER JOIN personal p ON p.ci = s.ci_emisor WHERE s.ci_emisor = $ciP ORDER BY fecha DESC");
$count_results = mysqli_num_rows($regisview);

//Si ha resultados
if ($count_results > 0) {
    //Muestra la cantidad de usuarios
    $apr = array(
            "0" => "alert alert-secondary",
            "1" => "alert alert-success",
            "2" => "alert alert-danger",
            "3" => "alert alert-dark",
    );
    $aprN = array(
        "0" => "pendiente",
        "1" => "aceptada",
        "2" => "rechasada",
        "3" => "vencida",
    );
    echo '<h6>total de solicitudes realizadas '.$count_results.'.</h6>';

    while ($row_searched = mysqli_fetch_array($regisview)){
        //Lista de los usuarios
        echo '<tr data-solicitud="'.$row_searched['id_solicitud'].'">';
        echo '<td><a>'.$row_searched['id_solicitud'].'</a></td>';
        echo '<td><a class="lol" href="principal.php?perfil='.encriptar($row_searched['ci_solicitada']).'&parce=true">'.$row_searched['ci_solicitada'].'</a></td>';
        echo '<td><a>'.$row_searched['fecha'].'</a></td>';
        echo '<td><a class="viewDetails btn btn"> Ver detalles </a></td>';    
        echo '<td><a class="'.$apr[$row_searched['apr_estado']].'">'.$aprN[$row_searched['apr_estado']].'</a></td>';
        echo '</tr>';
    }
}else {
        //Si no hay registros encontrados
        echo '<h5>no has realizado ninguna solicitud</h5>';
}
$connec->close();
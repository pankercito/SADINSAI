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
            "3" => "alert alert-dark",
    );
    $aprN = array(
        "0" => "pendiente",
        "1" => "aceptada",
        "2" => "rechasada",
        "3" => "vencida",
    );
    echo '<h6>total de solicitudes en espera '.$count_results.'.</h6>';

    while ($row_searched = mysqli_fetch_array($regisview)){
        //Lista de los usuarios
        echo '<tr>';
        echo '<td><a>'.$row_searched['id_solicitud'].'</a></td>';
        echo '<td><a class="lol" href="principal.php?perfil='.encriptar($row_searched['ci']).'&parce=true">'.$row_searched['ci'].'</a></td>';
        echo '<td><a class="lol" href="principal.php?perfil='.encriptar($row_searched['ci_solicitada']).'&parce=true">'.$row_searched['ci_solicitada'].'</a></td>';
        echo '<td><a>'.$row_searched['fecha'].'</a></td>';
        echo '<td><a>'.ucfirst(strtolower($row_searched['motivo'])).'</a></td>';        
        echo '<td><a class="'.$apr[$row_searched['apr_estado']].'">'.$aprN[$row_searched['apr_estado']].'</a></td>';
        echo '</tr>';
    }
}else {
    //Si no hay registros encontrados
    echo '<h2>no posee ninguna solicitud</h2>';
}
$connec->close();
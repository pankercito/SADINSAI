<?php

include ("conect.php");

$regisview = mysqli_query($connec,"SELECT * FROM registro r INNER JOIN perfiles p ON r.ci = p.ci");
    
$count_results = mysqli_num_rows($regisview);

//Si ha resultados

if ($count_results > 0) {
    //Muestra la cantidad de usuarios    
    echo '<h2>Se han registrado '.$count_results.' usuarios.</h2>';
    while ($row_searched = mysqli_fetch_array($regisview)){
        //Lista de los usuarios
        echo '<tr>';
        echo '<td><a></a></td>';
        echo '<td><a id="vrname" href="?perfil='.$row_searched['ci'].'&parce=true">'.$row_searched['ci'].'</a></td>';
        echo '<td><a>'.$row_searched['nombre'].'</a></td>';
        echo '<td><a>'.$row_searched['apellido'].'</a></td>';
        echo '<td><a>'.$row_searched['user'].'</a></td>';
        echo '</tr>';
    }
}else {
        //Si no hay registros encontrados
        echo '<h2>No se encuentran resultados con los criterios de búsqueda.</h2>';
    }
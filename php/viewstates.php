<?php

include ("../sadinsai/php/conect.php");

$registro = 'estados';

$regisview = mysqli_query($connec,"SELECT * FROM $registro");
    
$count_results = mysqli_num_rows($regisview);

//Si ha resultados

if ($count_results > 0) {
    //Muestra la cantidad de usuarios
    
    while ($row_searched = mysqli_fetch_array($regisview)){
        //Lista de los usuarios
        echo '<tr>';
        echo '<td><a>'.$row_searched['id_estado'].'</a></td>';
        echo '<td><a>'.$row_searched['estado'].'</a></td>';
        echo '</tr>';
    }
}
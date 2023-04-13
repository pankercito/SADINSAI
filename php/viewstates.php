<?php

include ("conect.php");

$regisview = mysqli_query($connec,"SELECT * FROM estados");
    
$count_results = mysqli_num_rows($regisview);

//Si ha resultados

if ($count_results > 0) {
    
    //Muestra la cantidad de usuarios  
    $states = 0;
    
    while($states != 24){
        //Lista de los usuarios
        $row_searched = mysqli_fetch_array($regisview);

        echo '<tr>';
        echo '<td><a></a></td>';
        echo '<td style="border-left: none;"><a class="idsvtate">'.$row_searched['id_estado'].'</a></td>';
        echo '<td style="border-left: 1px solid #dee2e6;"><a class="svtate"  href="?onlystate='.$row_searched['id_estado'].'">'.$row_searched['estado'].'</a></td>';
        echo '</tr>';
        $states ++;

    }
}
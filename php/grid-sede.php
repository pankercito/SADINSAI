<?php

    $v_tabla = 'perfiles'; //tabla

    $v_colum = 'id_sede'; //columna de la tabla
    
    $v_data = $_GET['onlysede']; //dato a comparar

    include_once('query.where.php');

    $count_results = mysqli_num_rows($regisview);

    while($row_searched = mysqli_fetch_array($regisview)){
        //Lista de los usuarios
        
        echo '<tr>';
        echo '<td><a></a></td>';
        echo '<td style="border-left: none;"><a class="idsvtate" href="?perfil='.$row_searched['ci'].'&parce=true">'.$row_searched['ci'].'</a></td>';
        echo '<td style="border-left: none;"><a class="idsvtate" >'.$row_searched['nombre'].'</a></td>';
        echo '<td style="border-left: 1px solid #dee2e6;"><a class="svtate">'.$row_searched['apellido'].'</a></td>';
        echo '<td style="border-left: 1px solid #dee2e6;"><a class="svtate">'.$row_searched['telefono'].'</a></td>';
        echo '</tr>';
    }

    

<?php

    $v_tabla = 'sedes'; //tabla

    $v_colum = 'id_estado'; //columna de la tabla
    
    $v_data = $_GET['onlystate']; //dato a comparar

    include_once('query.where.php');

    $count_results = mysqli_num_rows($regisview);

    while($row_searched = mysqli_fetch_array($regisview)){
        //Lista de los usuarios
        echo '<tr>';
        echo '<td><a></a></td>';
        echo '<td style="border-left: none;"><a class="idsvtate" >'.$row_searched['estado'].'</a></td>';
        echo '<td style="border-left: none;"><a class="idsvtate" href="?onlysede='.$row_searched['sede_id'].'">'.$row_searched['nombre_sede'].'</a></td>';
        echo '<td style="border-left: 1px solid #dee2e6;"><a class="svtate">'.$row_searched['municipio'].'</a></td>';
        echo '</tr>';
    }
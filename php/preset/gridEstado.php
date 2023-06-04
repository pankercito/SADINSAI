<?php
        
    include('../php/conect.php');

    $stonly = $_GET['onlystate'];
    
    $sql = mysqli_query($connec,"SELECT * FROM estados e INNER JOIN sedes s ON e.id_estado = s.id_estado WHERE s.id_estado = '$stonly'");

    $count_results = mysqli_num_rows($sql);

    while($row_searched = mysqli_fetch_array($sql)){
        //Lista de los usuarios
        echo '<tr>';
        echo '<td><a></a></td>';
        echo '<td style="border-left: none;"><a class="idsvtate" >'.$row_searched['estado'].'</a></td>';
        echo '<td style="border-left: none;"><a class="idsvtate" href=?onlystate='.$stonly.'&onlysede='.$row_searched['sede_id'].'>'.ucwords(strtolower($row_searched['nombre_sede'])).'</a></td>';
        echo '<td style="border-left: 1px solid #dee2e6;"><a class="svtate">'.ucwords(strtolower($row_searched['municipio'])).'</a></td>';
        echo '</tr>';
    }
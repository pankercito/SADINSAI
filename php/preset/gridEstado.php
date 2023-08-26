<?php

    $stonly = $_GET['onlystate'];
    
    $sql = $conn->query("SELECT * FROM estados e INNER JOIN sedes s ON e.id_estado = s.id_estado WHERE s.id_estado = '$stonly'");

    $count_results = mysqli_num_rows($sql);

    while($v = mysqli_fetch_array($sql)){
        //Lista de los usuarios
        echo '<tr>';
        echo '<td><a></a></td>';
        echo '<td style="border-left: none;"><a class="idsvtate" >'.$v['estado'].'</a></td>';
        echo '<td style="border-left: none;"><a class="idsvtate" href=?onlystate='.$stonly.'&onlysede='.$v['sede_id'].'>'.ucwords(strtolower($v['nombre_sede'])).'</a></td>';
        echo '<td style="border-left: 1px solid #dee2e6;"><a class="svtate">'.ucwords(strtolower($v['municipio'])).'</a></td>';
        echo '</tr>';
    }
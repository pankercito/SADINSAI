<?php

    include('conect.php');

    $sdonly = $_GET['onlysede'];

    $sql = mysqli_query($connec,"SELECT * FROM personal WHERE sede_id = '$sdonly'");

    $count_results = mysqli_num_rows($sql);

    while($row_searched = mysqli_fetch_array($sql)){
        
        //Lista de los usuarios
        echo '<tr>';
        echo '<td><a></a></td>';
        echo '<td style="border-left: none;"><a class="idsvtate" href="?perfil='.$row_searched['ci'].'&parce=true">'.$row_searched['ci'].'</a></td>';
        echo '<td style="border-left: none;"><a class="idsvtate" >'.ucwords(strtolower($row_searched['nombre'])).'</a></td>';
        echo '<td style="border-left: 1px solid #dee2e6;"><a class="svtate">'.ucwords(strtolower($row_searched['apellido'])).'</a></td>';
        echo '<td style="border-left: 1px solid #dee2e6;"><a class="svtate">'.$row_searched['telefono'].'</a></td>';
        echo '</tr>';
    }

    

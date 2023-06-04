<?php

include ("../php/conect.php");

$regisview = mysqli_query($connec,"SELECT estados.id_estado, estados.estado, COUNT(sedes.sede_id) AS total_sedes
                                    FROM estados
                                    INNER JOIN sedes ON estados.id_estado = sedes.id_estado
                                    GROUP BY estados.id_estado");
    
$count = mysqli_num_rows($regisview);

//Si ha resultados
if ($count > 0) {
    
    for($states = 0; $states < $count; $states ++){    
    //Lista de los usuarios
    $row_searched = mysqli_fetch_array($regisview);

        echo '<tr>';
        echo '<td><a></a></td>';
        echo '<td style="border-left: none;"><a class="idsvtate">'.$row_searched['id_estado'].'</a></td>';
        echo '<td style="border-left: 1px solid #dee2e6;"><a class="svtate"  href="?onlystate='.$row_searched['id_estado'].'">'.$row_searched['estado'].'</a></td>';
        echo '<td style="border-left: 1px solid #dee2e6;"><a class="totalsede">'.$row_searched['total_sedes'].'</a></td>';
        echo '</tr>';
        
    }
}
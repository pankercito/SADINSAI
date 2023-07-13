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
        echo '<li class="stdI d-grid gap-2">
                <a  class="estado btn btn-sm" href="?onlystate='.$row_searched['id_estado'].'"><i class="bi bi-window-stack"></i> '.$row_searched['estado'].'</a>
              </li>';
     
    }
}
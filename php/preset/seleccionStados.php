<?php

$sql = $conn->query( "SELECT * FROM sedes s
                               JOIN estados e
                               JOIN personal p
                               ON e.id_estado = s.id_estado_sed 
                               AND p.sede_id = s.sede_id");

$count = mysqli_num_rows($sql);

//Si ha resultados
if ($count > 0) {

    for ($states = 0; $states < $count; $states++) {
        //Lista de los usuarios
        $v = mysqli_fetch_array($sql);
        echo '<tr>';
        echo '<td>'. strtoupper(remover_acentos($v['estado'])) .'</td>';
        echo '<td>'. remover_acentos($v['nombre_sede']).'</td>';
        echo '<td>'. remover_acentos($v['nombre']). '</a></td>';
        echo '<td>'. remover_acentos($v['apellido']). '</a></td>';
        echo '<td>'. remover_acentos($v['ci']). '</a></td>';
        echo '<td>'. remover_acentos($v['telefono']). '</a></td>';
        echo '<td>'. remover_acentos($v['cargo']). '</a></td>';
        echo '</tr>';
    }

}
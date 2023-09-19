<?php

$sql = $conn->query("SELECT * FROM sedes s
                               JOIN estados e
                               JOIN personal p
                               JOIN cargo c
                               ON e.id_estado = s.id_estado_sed 
                               AND p.sede_id = s.sede_id
                               and c.id_cargo = p.cargo");

$count = mysqli_num_rows($sql);

//Si ha resultados
if ($count > 0) {

    while ($v = mysqli_fetch_array($sql)) {

        //Lista del personal
        echo '<tr>';
        echo '<td>' . strtoupper(remover_acentos($v['estado'])) . '</td>';
        echo '<td>' . remover_acentos($v['nombre_sede']) . '</td>';
        echo '<td><a class="aStates" href="perfil.php?perfil=' . encriptar($v['ci']) . '&parce=true">' . remover_acentos($v['nombre']) . '</a></td>';
        echo '<td>' . remover_acentos($v['apellido']) . '</td>';
        echo '<td>' . remover_acentos($v['ci']) . '</td>';
        echo '<td>' . remover_acentos($v['telefono']) . '</td>';
        echo '<td>' . remover_acentos($v['cargo_nombre']) . '</td>';
        echo '</tr>';
    }

}
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

    while ($v = $sql->fetch_assoc()) {

        //Lista del personal
        echo '<tr>';
        echo '<td>' . cor_acentos($v['estado']) . '</td>';
        echo '<td>' . strtolower(cor_acentos($v['nombre_sede'])) . '</td>';
        echo '<td><a class="aStates" href="perfil.php?perfil=' . encriptar($v['ci']) . '&parce=true">' . strtolower($v['nombre']) . '</a></td>';
        echo '<td>' . strtolower($v['apellido']) . '</td>';
        echo '<td>' . strtolower($v['ci']) . '</td>';
        echo '<td>' . strtolower($v['telefono']) . '</td>';
        echo '<td>' . strtolower($v['cargo_nombre']) . '</td>';
        echo '</tr>';
    }

}
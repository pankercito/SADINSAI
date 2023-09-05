<?php
include_once("../php/conx.php");
$conn = new Conexion();

$est = $conn->real_escape($_POST['estado']);

$sql = $conn->query("SELECT * FROM sedes s
                    JOIN estados e
                    JOIN personal p
                    ON e.id_estado = s.id_estado_sed 
                    AND p.sede_id = s.sede_id
                    WHERE p.sede = $est");

$count = mysqli_num_rows($sql);

//Si ha resultados
if ($count > 0) {

    for ($states = 0; $states < $count; $states++) {
        //Lista del personal
        $v = mysqli_fetch_array($sql);
        echo '<tr>';
        echo '<td>' . strtoupper(remover_acentos($v['estado'])) . '</td>';
        echo '<td>' . remover_acentos($v['nombre_sede']) . '</td>';
        echo '<td><a class="aStates" href="perfil.php?perfil=' . encriptar($v['ci']) . '">' . remover_acentos($v['nombre']) . '</a></td>';
        echo '<td>' . remover_acentos($v['apellido']) . '</td>';
        echo '<td>' . remover_acentos($v['ci']) . '</td>';
        echo '<td>' . remover_acentos($v['telefono']) . '</td>';
        echo '<td>' . remover_acentos($v['cargo']) . '</td>';
        echo '</tr>';
    }

}
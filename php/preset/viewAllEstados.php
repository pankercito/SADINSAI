<?php
if (!class_exists('Conexion')) {
    include "../class/conx.php";
}
//sedes por estado
$regisview = $conn->query("SELECT estados.id_estado, estados.estado, COUNT(sedes.sede_id) AS total_sedes
                                    FROM estados
                                    INNER JOIN sedes ON estados.id_estado = sedes.id_estado_sed
                                    GROUP BY estados.id_estado");

$count = mysqli_num_rows($regisview);

//Si ha resultados
if ($count > 0) {
    for ($states = 0; $states < $count; $states++) {
        //Lista de los usuarios
        $v = mysqli_fetch_array($regisview);
        echo '
                <option value=' . $v['id_estado'] . '>' . $v['estado'] . '     total de sedes: ' . $v['total_sedes'] . '</option>
              ';

    }
}
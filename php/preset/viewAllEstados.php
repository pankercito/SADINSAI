<?php

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
                <option value=' . strtoupper(remover_acentos($v['estado'])) . '">' . remover_acentos($v['estado']) . '</option>
              ';

    }
}
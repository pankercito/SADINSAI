<?php

include "../class/conx.php";
$conn = new Conexion;

$sql = $conn->query("SELECT * FROM sedes s INNER JOIN estados e ON s.id_estado_sed = e.id_estado");

$count_results = mysqli_num_rows($sql);

if ($count_results !== 0) {
    $i = 1;
    while ($v = $sql->fetch_object()) {
        //Lista de los usuarios
        $arroz[] = [
            $i,
            ucwords(strtolower($v->estado)),
            ucwords(strtolower($v->nombre_sede)),
            ucwords(strtolower($v->dir_local))
        ];
        $i++;
    }
}

echo json_encode(['data' => $arroz]);
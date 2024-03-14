<?php
include "../class/conx.php";

$conn = new Conexion();

$sql1 = $conn->query("SELECT * FROM `cargo`");

$sql = $conn->query("SELECT id_cargo, cargo_nombre, COUNT(p.cargo) AS afiliados FROM cargo c 
                            INNER JOIN personal p ON p.cargo
                            = c.id_cargo GROUP BY c.id_cargo , c.cargo_nombre");

$valores = [];
while ($v = $sql->fetch_object()) {
    $valores[$v->id_cargo] = $v->afiliados;
}

$cargos = [];
while ($v = $sql1->fetch_object()) {
    $cargos[$v->id_cargo] = $v->cargo_nombre;
}

$count_results = mysqli_num_rows($sql);

if ($count_results !== 0) {
    $i = 1;
    foreach ($cargos as $v => $val) {
        //Lista de los usuarios
        $array[] = [
            $i,
            ucwords(strtolower($val)),
            ucwords(strtolower((isset($valores[$v])) ? $valores[$v] : 0)),
        ];

        $i++;
    }
    // crear un array con el array de los datos, importante que esten dentro de : data
    $new_array = array("data" => $array);
    // crear el JSON apartir de los arrays
    echo json_encode($new_array);
}
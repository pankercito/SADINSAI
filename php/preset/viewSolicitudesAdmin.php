<?php

include "../preset/presetConfigIncludes.php";

session_start();

$conn = new Conexion();

$regisview = $conn->query("SELECT * FROM solicitudes s INNER JOIN registro r GROUP by s.id_solicitud");
$count_results = mysqli_num_rows($regisview);


$apr = [
    "0" => "alert alert-secondary",
    "1" => "alert alert-success",
    "2" => "alert alert-danger",
    "3" => "alert alert-primary",
];
$aprN = [
    "0" => "pendiente",
    "1" => "aceptada",
    "2" => "rechazada",
    "3" => "anulada",
];
$aprL = [
    "0" => 'bi bi-person-lines-fill',
    "1" => 'bi bi-person-fill-check',
    "2" => 'bi bi-person-fill-x',
    "3" => 'bi bi-person-fill-x'
];
$tipoSolic = [
    "0" => "ingreso de personal",
    "1" => "edicion de datos",
    "2" => "ingreso de archivo",
    "3" => "eliminacion de archivo",
    "4" => "recuperacion de contraseña"
];

//Si ha resultados
if ($count_results > 0) {

    $data = [];
    while ($data = $regisview->fetch_object()) {
        // Poner los datos en un array en el orden de los campos de la tabla
        $disabled = ($data->apr_estado != 0) ? "" : "aprStates(" . $data->id_solicitud . "," . $data->tipo . ")";

        $data_array[] = [
            $data->id_solicitud,
            '<a class="lol" href="perfil.php?perfil=' . encriptar($data->ci_solicitada) . '&parce=true">' . strtoupper($data->user) . '</a>',
            $data->fecha,
            $tipoSolic[$data->tipo],
            '<a onclick="detalles(' . $data->id_solicitud . ',' . $data->tipo . ')" class="viewDetails btn btn"> Ver detalles </a>',
            '<a onclick="' . $disabled . '" class="aprState ' . $apr[$data->apr_estado] . '">' . $aprN[$data->apr_estado] . '<span style="margin:.5rem;"></span><i class="' . $aprL[$data->apr_estado] . '"></i></a>',
            $data->apr_estado
        ];
    }
    // crear un array con el array de los datos, importante que esten dentro de : data
    $new_array = array("data" => $data_array);
    // crear el JSON apartir de los arrays
    echo json_encode($new_array);
} else {
    //Si no hay registros encontrados
    echo '<h6>no posee ninguna solicitud</h6>';
}
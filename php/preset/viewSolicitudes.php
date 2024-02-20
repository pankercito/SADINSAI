<?php

include "../class/conx.php";
include "../function/getUser.php";
include "../function/criptCodes.php";

session_start();

$conn = new Conexion();

$id = $_SESSION['sesion'];

$regisview = $conn->query("SELECT * FROM solicitudes WHERE id_emisor = $id");
$count_results = mysqli_num_rows($regisview);

$apr = [
    "0" => "alert alert-secondary",
    "1" => "alert alert-success",
    "2" => "alert alert-danger",
    "3" => "alert alert-dark",
];
$aprN = [
    "0" => "pendiente",
    "1" => "aceptada",
    "2" => "rechazada",
    "3" => "anulada",
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
            '<a class="lol" href="perfil.php?perfil=' . encriptar($data->ci_solicitada) . '&parce=true">' . $data->ci_solicitada . '</a>',
            $data->fecha,
            $tipoSolic[$data->tipo],
            '<a onclick="detalles(' . $data->id_solicitud . ',' . $data->tipo . ')" class="viewDetails btn btn"> Ver detalles </a>',
            '<a class="' . $apr[$data->apr_estado] . '">' . $aprN[$data->apr_estado] . '</a>  ',
            $data->apr_estado
        ];
    }
    // crear un array con el array de los datos, importante que esten dentro de : data
    $new_array = array("data" => $data_array);
    // crear el JSON apartir de los arrays
    echo json_encode($new_array);
} else {
    //Si no hay registros encontrados
    $new_array = ["data" => [['','','','no haz realizado ninguna getion','','','']]];
    // crear el JSON apartir de los arrays
    echo json_encode($new_array);
}
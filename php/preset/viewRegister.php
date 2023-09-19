<?php

include('../conx.php');
include("../function/criptCodes.php");

$conn = new Conexion();

$regisview = $conn->query("SELECT * FROM registro r INNER JOIN personal p ON r.ci = p.ci");

//Si ha resultados
if ($regisview->num_rows > 0) {

    $v = [];
    while ($v = $regisview->fetch_object()) {

        $r = ($v->active != 1) ? '<div class="d-inline-flex"><a class="pan alert alert-secondary">desactivado</a><span class="e mx-1"></span><a onclick="gestionUser(' . $v->id_usuario . ')". class="pencil alert alert-warning" ><i class="bi bi-pencil"></i></a></div>'
                               : '<div class="d-inline-flex"><a class="panel alert alert-success">activo</a><span class="e mx-1"></span><a  onclick="gestionUser(' . $v->id_usuario . ')" class="pencil alert alert-warning"><i class="bi bi-pencil"></i></a></div>';

        // Poner los datos en un array en el orden de los campos de la tabla
        $data[] = [
            "<a class='vrname href='perfil.php?perfil=" . encriptar($v->ci) . "&parce=true'>" . strtoupper(strtolower($v->user)) . "</a>",
            ucwords(strtolower($v->nombre)),
            ucwords(strtolower($v->apellido)),
            $v->ci,
            $r
        ];


    }
    // crear un array con el array de los datos, importante que esten dentro de : data
    $new_array = array("data" => $data);
    // crear el JSON apartir de los arrays
    echo json_encode($new_array);
} else {
    //Si no hay registros encontrados
    $data[] = [
        "error no se",
        "encuentran",
        "resultados ",
        "con los criterios",
        "de busqueda"
    ];
    $new_array = array("data" => $data);
    // crear el JSON apartir de los arrays
    echo json_encode($new_array);
}
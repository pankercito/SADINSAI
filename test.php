<?php






include "php/conx.php";


$conn = new Conexion;

$precarInf = $conn->query("SELECT * FROM solicitudes_precarga WHERE id_solicitud_precarga = '85312840'");


while ($a = $precarInf->fetch_object()) {
    $arrayB = [
        "ci" => $a->ci_pre,
        "nombre" => $a->nombre_pre,
        "apellido" => $a->apelido_pre,
        "ciudad" => $a->id_ciudad_pre,
        "sexo" => $a->sexo_pre
    ];
    $ci = $a->ci_pre;
}


$inf = $conn->query("SELECT * FROM personal WHERE ci = '$ci'");


while ($c = $inf->fetch_object()) {
    $arrayA = [
        "ci" => $c->ci,
        "nombre" => $c->nombre,
        "apellido" => $c->apellido,
        "ciudad" => $c->id_ciudad,
        "sexo" => $c->sexo
    ];
}

$coun = count($arrayA);


$d = "Cambios aceptados por $arrayA->u a " . $arrayA['ci'] . " == ";

// Usamos array_diff_assoc() para obtener una lista de los elementos que han cambiado
$cambios = array_diff_assoc($arrayA, $arrayB);

// Recorremos la lista de cambios e imprimimos los cambios
foreach ($cambios as $clave => $valor) {
    if ($clave != $valor) {
        $d .= ucfirst(strtolower($clave)) . ": antes: " . strtolower($arrayA[$clave]) . " | despues: " . strtolower($arrayB[$clave]) . " //";
    }
}


echo $d;
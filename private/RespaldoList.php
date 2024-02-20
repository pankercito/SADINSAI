<?php

define('DIR', '../data/backup');
function RespaldoList()
{
    $archivos = array_diff(scandir('../data/backup/'), ['.', '..']);

    return $archivos;
}


$datos = RespaldoList();
$i = 0;

foreach ($datos as $keys) {
    $i++;

    $array[] = [
        $i,
        $keys,
        '<a class="btn btn-success" href="' . DIR . '/' . $keys . '"><i class="bi bi-download"></i></a>'
    ];
}

echo json_encode(['data' => $array]);
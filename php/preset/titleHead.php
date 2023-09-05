<?php

include('statesHead.php');

include('../php/function/fHead.php');

// Guardar el nombre de los URL *Direccion* => *Nombre que tendra*
$titles = [
    'perfil' => 'perfil',
    '/sadinsai/public/principal.php' => 'Dashboard',
    '/sadinsai/public/perfil.php' => 'perfil',
    '/sadinsai/public/estados.php' => 'Personal',
    '/sadinsai/public/nomina.php' => 'Nomina',
    '/sadinsai/public/anadir.php' => 'A&ntilde;adir',
    '/sadinsai/public/solicitudes.php' => 'Solicitudes',
    '/sadinsai/public/anadir.php?users/viewregister=true' => 'Usuarios Registrados',
    '/sadinsai/public/anadir.php?users/register=true' => 'Registrar Usuarios',
    '/sadinsai/public/anadir.php?users/register-two=true' => 'Registrar Usuarios',
    '/sadinsai/public/anadir.php?form=true' => 'Agregar Personal',
];

// URL actual sin los parámetros GET
$actUrl = strtok($_SERVER['REQUEST_URI'], '?');

// URL con todo y GETs
$get = $_SERVER['REQUEST_URI'];

// Solo Parámetros GET de la URL actual
parse_str(parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY), $params);

// Obtener el título correspondiente a la URL actual
if ($actUrl == '/sadinsai/public/perfil.php') {
    //Pagina de inicio o Perfil
    include('../php/perfilCheck.php');

    //Imprimir tanto perfil como el Nombre si se detecta el GET "parce"
    encabezado('Perfil' . (isset($params['parce']) ? ' de ' . $pName : ''));
} else
    if (isset($params['onlystate'])) {
        //Imprimir titulos de estados
        encabezado($estados[($params['onlystate'])] . (isset($params['onlysede']) ? ' | ' . $sedes[($params['onlysede'])] : ''));
    } else
        if (isset($params['onlysede'])) {
            //Imprimir titulos de sede
            $title = $estados[($params['onlystate'])] + $sedes[($params['onlysede'])];

            encabezado($title);
        } else {
            //Imprimir los demas GETs enteros segun la URL
            $title = isset($titles[$get]) ? $titles[$get] : 'No agregado';

            encabezado($title);
        }
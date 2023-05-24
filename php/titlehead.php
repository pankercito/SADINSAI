<?php

include('fHead.php');

include('statesHead.php');

// Guardar el nombre de los URL *Direccion* => *Nombre que tendra*
$titles = array(
    'perfil' => 'perfil',
    '/sadinsai/public/principal.php' => 'perfil',
    '/sadinsai/public/estados.php' => 'Estados',
    '/sadinsai/public/nomina.php' => 'Nomina',
    '/sadinsai/public/anadir.php' => 'A&ntilde;adir',
    '/sadinsai/public/solicitudes.php' => 'Solicitudes',
    '/sadinsai/public/anadir.php?users/viewregister=true' => 'Usuarios Registrados',
    '/sadinsai/public/anadir.php?users/register=true' => 'Registrar Usuarios',
    '/sadinsai/public/anadir.php?users/register-two=true' => 'Registrar Usuarios',
    '/sadinsai/public/anadir.php?form=true' => 'Agregar Personal',
);

// URL actual sin los parámetros GET
$current_url = strtok($_SERVER['REQUEST_URI'], '?');

// URL con todo y GETs
$get = $_SERVER['REQUEST_URI'];

// Solo Parámetros GET de la URL actual
parse_str(parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY), $params);

// Obtener el título correspondiente a la URL actual
if ($current_url == '/sadinsai/public/principal.php') {
    //Pagina de inicio o Perfil
    include('perfilCheck.php');
    
    //Imprimir tanto perfil como el Nombre si se detecta el GET "parce"
    encabezado('Perfil' . (isset($params['parce']) ? ' de ' . $pname : ''));
}else 
if(isset($params['onlystate'])){
    //Imprimir titulos de estados
    $title = $estados[($params['onlystate'])];
    
    encabezado($title);
}else{
    //Imprimir los demas GETs enteros segun la URL
    $title = isset($titles[$get]) ? $titles[$get] : 'No agregado';

    encabezado($title);
}
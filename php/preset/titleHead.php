<?php

include('statesHead.php');

include('../php/function/fHead.php');

// Guardar el nombre de los URL *Direccion* => *Nombre que tendra*
$titles = [
    'perfil' => 'perfil',
    '/sadinsai/public/principal.php' => 'Inicio',
    '/sadinsai/public/sysAdmin.php' => 'Inicio',
    '/sadinsai/private/recovery.php' => 'Recuperacion de Contrase&nacute;a',
    '/sadinsai/public/perfil.php' => 'Perfil',
    '/sadinsai/public/estados.php' => 'Personal',
    '/sadinsai/public/anadir.php' => 'A&ntilde;adir',
    '/sadinsai/public/solicitudes.php' => 'Solicitudes',
    '/sadinsai/public/anadir.php?users/viewregister=true' => 'Usuarios Registrados',
    '/sadinsai/public/anadir.php?users/register=true' => 'Registrar Usuarios',
    '/sadinsai/public/anadir.php?users/register-two=true' => 'Registrar Usuarios',
    '/sadinsai/public/anadir.php?form=true' => 'Agregar Personal',
    '/sadinsai/private/planilla-1.php' => 'Documento',
    '/sadinsai/private/planilla-2.php' => 'Documento',
    '/sadinsai/private/planilla-3.php' => 'Documento',
    '/sadinsai/private/planilla-4.php' => 'Documento',
    '/sadinsai/private/planilla-5.php' => 'Documento',
];

// URL actual sin los parámetros GET
$actUrl = strtok($_SERVER['REQUEST_URI'], '?');

// URL con todo y GETs
$get = $_SERVER['REQUEST_URI'];

// Obtener el título correspondiente a la URL actual
if ($actUrl == '/sadinsai/public/perfil.php') {
    //Pagina de inicio o Perfil
    include('../php/perfilCheck.php');

    //Imprimir tanto perfil como el Nombre si se detecta el GET "parce"
    encabezado('Perfil' . (isset($_GET['parce']) ? ' de ' . $pName : ''));
} else {
    //Imprimir los demas GETs enteros segun la URL
    $title = isset($titles[$get]) ? $titles[$get] : 'No agregado';

    encabezado($title);
}
<?php

include('statesHead.php');

include('../php/function/fHead.php');

// Guardar el nombre de los URL *Direccion* => *Nombre que tendra*
$titles = [
    'perfil' => 'perfil',
    '/public/principal.php' => 'Inicio',
    '/public/sysAdmin.php' => 'Inicio',
    '/private/recovery.php' => 'Recuperacion de Contrase&nacute;a',
    '/public/perfil.php' => 'Perfil',
    '/public/estados.php' => 'Personal',
    '/public/anadir.php' => 'A&ntilde;adir',
    '/public/solicitudes.php' => 'Solicitudes',
    '/public/anadir.php?users/viewregister=true' => 'Usuarios Registrados',
    '/public/anadir.php?users/register=true' => 'Registrar Usuarios',
    '/public/anadir.php?users/register-two=true' => 'Registrar Usuarios',
    '/public/anadir.php?form=true' => 'Agregar Personal',
    '/private/backRec.php' => 'Respaldo',
    '/components/cargos.php' => 'Cargos',
    '/components/sedes.php' => 'Sedes',
    '/components/recovery.php' => 'Recuperacion de contraseña'
];

// URL actual sin los parámetros GET
$actUrl = strtok($_SERVER['REQUEST_URI'], '?');

// URL con todo y GETs
$get = $_SERVER['REQUEST_URI'];

// Obtener el título correspondiente a la URL actual
if ($actUrl == '/public/perfil.php') {
    //Pagina de inicio o Perfil
    include('../php/perfilCheck.php');

    //Imprimir tanto perfil como el Nombre si se detecta el GET "parce"
    encabezado('Perfil' . (isset($_GET['parce']) ? ' de ' . $pName : ''));
} else {
    //Imprimir los demas GETs enteros segun la URL
    $title = isset($titles[$get]) ? $titles[$get] : 'No agregado';

    encabezado($title);
}
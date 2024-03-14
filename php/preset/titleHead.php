<?php

// Guardar el nombre de los URL *Direccion* => *Nombre que tendra*
$titles = [
    '/public/perfil.php' => 'Perfil',
    '/public/principal.php' => 'Inicio',
    '/public/sysAdmin.php' => 'Inicio',
    '/private/recovery.php' => 'Recuperacion de contraseña',
    '/public/personal.php' => 'Personal',
    '/public/anadir.php' => 'Añadir',
    '/public/solicitudes.php' => 'Solicitudes',
    '/public/gestionData.php' => 'Gestiones de Datos',
    '/public/anadir.php?users/viewregister=true' => 'Usuarios Registrados',
    '/public/anadir.php?users/register=true' => 'Registrar Usuarios',
    '/public/anadir.php?users/register-two=true' => 'Registrar Usuarios',
    '/public/anadir.php?form=true' => 'Agregar Personal',
    '/private/backRec.php' => 'Respaldo',
    '/components/cargos.php' => 'Cargos',
    '/components/sedes.php' => 'Sedes',
    '/components/recovery.php' => 'Recuperacion de contraseña',
    '/components/active_account.php' => 'Activar Usuario',
];

if (!function_exists('encabezado')) {
    include "../php/function/fHead.php";
}

// URL actual sin los parámetros GET
$actUrl = strtok($_SERVER['REQUEST_URI'], '?');

// URL con todo y GETs
$get = $_SERVER['REQUEST_URI'];

// Obtener el título correspondiente a la URL actual
if ($actUrl == '/public/perfil.php') {
    //Pagina de inicio o Perfil
    include "../php/perfilCheck.php";

    //Imprimir tanto perfil como el Nombre si se detecta el GET "parce"
    encabezado('Perfil' . (isset($_GET['parce']) ? ' de ' . $pName : ''));
} else {
    //Imprimir los demas GETs enteros segun la URL
    $title = isset($titles[$get]) ? $titles[$get] : 'No agregado';

    encabezado($title);
}
<?php


include('Fhead.php');

if(isset($_GET['perfil'])){
    
    include('perfilcheck.php');
    $titulo = "Perfil";
    encabezado($titulo);

}
if(isset($_GET['parce'])){
    
    $titulo = ' de ' .$pname;
    encabezado($titulo);

}
if(isset($_GET['users'])){

    $titulo = "Usuarios";
    encabezado($titulo);

}
if(isset($_GET['users/viewregister'])){

    $titulo = "Usuarios Registrados";
    encabezado($titulo);

}
if(isset($_GET['users/register'])){

    $titulo = "Registrar Usuarios";
    encabezado($titulo);

}
if(isset($_GET['users/register-two'])){

    $titulo = "Registrar Usuarios";
    encabezado($titulo);

}
if(isset($_GET['states'])){

    $titulo = "Estados";
    encabezado($titulo);

}

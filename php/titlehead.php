<?php

<<<<<<< HEAD
include('Fhead.php');

echo "SADINSAI ";
=======

include('Fhead.php');
>>>>>>> ef454668b094ed648e94e17d925e51a7f585f6bd

if(isset($_GET['perfil'])){
    
    include('perfilcheck.php');
<<<<<<< HEAD
    $titulo = "| Perfil";
=======
    $titulo = "Perfil";
>>>>>>> ef454668b094ed648e94e17d925e51a7f585f6bd
    encabezado($titulo);

}
if(isset($_GET['parce'])){
    
    $titulo = ' de ' .$pname;
    encabezado($titulo);

}
if(isset($_GET['users'])){

<<<<<<< HEAD
    $titulo = "| Usuarios";
=======
    $titulo = "Usuarios";
>>>>>>> ef454668b094ed648e94e17d925e51a7f585f6bd
    encabezado($titulo);

}
if(isset($_GET['users/viewregister'])){

<<<<<<< HEAD
    $titulo = "| Usuarios Registrados";
=======
    $titulo = "Usuarios Registrados";
>>>>>>> ef454668b094ed648e94e17d925e51a7f585f6bd
    encabezado($titulo);

}
if(isset($_GET['users/register'])){

<<<<<<< HEAD
    $titulo = "| Registrar Usuarios";
=======
    $titulo = "Registrar Usuarios";
>>>>>>> ef454668b094ed648e94e17d925e51a7f585f6bd
    encabezado($titulo);

}
if(isset($_GET['users/register-two'])){

<<<<<<< HEAD
    $titulo = "| Registrar Usuarios";
=======
    $titulo = "Registrar Usuarios";
>>>>>>> ef454668b094ed648e94e17d925e51a7f585f6bd
    encabezado($titulo);

}
if(isset($_GET['states'])){

<<<<<<< HEAD
    $titulo = "| Estados";
=======
    $titulo = "Estados";
>>>>>>> ef454668b094ed648e94e17d925e51a7f585f6bd
    encabezado($titulo);

}

<?php

include('Fhead.php');

echo "SADINSAI";

if(isset($_GET['perfil'])){
    
    include('perfilcheck.php');
    encabezado('Perfil');

    if(isset($_GET['parce'])){  
        encabezado(' de ' .$name);
    }
}else
if(isset($_GET['users'])){

    encabezado("Usuarios");
}else
if(isset($_GET['users/viewregister'])){

    encabezado("Usuarios Registrados");
}else
if(isset($_GET['users/register'])){

    encabezado("Registrar Usuarios");
}else
if(isset($_GET['users/register-two'])){

    encabezado("Registrar Usuarios");
}else
if(isset($_GET['states'])){

    encabezado("Estados");
}else
if(isset($_GET['nomina'])){

    encabezado("Nomina");
}else
if(!isset($_GET[''])){
    encabezado("Inicio de Sesi&oacute;n");
}

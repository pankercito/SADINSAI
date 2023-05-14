<?php

if (isset($_GET["form"])){
    require_once ("../layout/formulario.php");
}else
if(isset($_GET["users/register"])){
    require_once ("../layout/registrar.php");
}else
if(isset($_GET["users/register-two"])){
    require_once ("../layout/registrar2.php");
}else
if(isset($_GET["users/viewregister"])){
    require_once ("../layout/tablauser.php");
}else
if(isset($_GET["adminregister"])){
    require_once ("../php/adregis.php");
}else{
    echo "Elija una opcion :)";
}
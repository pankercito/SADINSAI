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
}else 
if(isset($_GET["error"])){
    echo "El proceso de registro a fallado por favor intente nuevamente <br>";
    echo '<img src="../recursos/banana-cat.gif" alt="GIF animado">';
}else
if(isset($_GET["exito"])){
    echo "El proceso de registro ha concluido exitosamente <br>";
    echo '<img src="../recursos/goocat.gif" alt="GIF animado">';
}else{
    echo "Elija una opcion :)";
}
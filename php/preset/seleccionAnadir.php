<?php

if (isset($_GET["form"])){
    require_once "../layout/formulario.php";
}else
if(isset($_GET["users/register"])){
    require_once "../layout/registrar.php";
}else
if(isset($_GET["users/register-two"])){
    require_once "../layout/registrar2.php";
}else
if(isset($_GET["users/viewregister"])){
    require_once "../layout/tablauser.php";
}else
if(isset($_GET["adminregister"])){
    require_once "../php/adregis.php";
}else 
if(isset($_GET["error"])){
    echo "<h6> el proceso de registro a fallado por favor intente nuevamente</h6>";
}else
if(isset($_GET["exito"])){
    echo "<h6>el proceso de registro ha concluido exitosamente</h6>";
}else{
    echo "<h6>eliga una opcion<h6>";
}
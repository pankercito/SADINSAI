<?php

if (isset($_GET["perfil"])){
    require_once ("layout/perfil.php");
}
if (isset($_GET["users"])){
    require_once ("layout/usuarios.php");
}  
if(isset($_GET["users/register"])){
    require_once ("layout/registrar.php");
}
if(isset($_GET["users/register-two"])){
    require_once ("layout/registrar2.php");
}
if(isset($_GET["users/viewregister"])){
    require_once ("layout/tablauser.php");
}
if(isset($_GET["states"])){
    require_once ("layout/tablestates.php");
}
if(isset($_GET["adminregister"])){
    require_once ("adregis.php");
}
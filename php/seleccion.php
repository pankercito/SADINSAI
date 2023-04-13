<?php

if (isset($_GET["perfil"])){
    require_once ("layout/perfil.php");
}else
if (isset($_GET["users"])){
    require_once ("layout/usuarios.php");
}else
if(isset($_GET["users/register"])){
    require_once ("layout/registrar.php");
}else
if(isset($_GET["users/register-two"])){
    require_once ("layout/registrar2.php");
}else
if(isset($_GET["users/viewregister"])){
    require_once ("layout/tablauser.php");
}else
if(isset($_GET["states"])){
    require_once ("layout/tablestates.php");
}else
if(isset($_GET["onlystate"])){
    require_once ("layout/statesgrid.php");
}else
if(isset($_GET["onlysede"])){
    require_once ("layout/sedegrid.php");
}else
if(isset($_GET["adminregister"])){
    require_once ("adregis.php");
}else
if(isset($_GET["scan"])){
    require_once("tesseract/form-image.php");
}else
if(isset($_GET["result"])){
    require_once("tesseract/init.php");
} else{
    echo "lo sentimos hay un error en el servidor :(";
}
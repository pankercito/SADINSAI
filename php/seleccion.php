<?php

if (isset($_GET["perfil"])){
    require_once ("../layout/perfil.php");
}else
if(isset($_GET["states"])){
    require_once ("../layout/tablestates.php");
}else
if(isset($_GET["onlystate"])){
    require_once ("../layout/oneEstadoGrid.php");
}else
if(isset($_GET["onlysede"])){
    require_once ("../layout/onlySedesGrid.php");
}else
if(isset($_GET["scan"])){
    require_once("../tesseract/form-image.php");
}else
if(isset($_GET["result"])){
    require_once("../tesseract/init.php");
} else{
    echo "lo sentimos hay un error en el servidor :(";
}
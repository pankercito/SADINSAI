<?php

if(isset($_GET["onlystate"]) && isset($_GET["onlysede"])){
    require_once ("../layout/onlySedesGrid.php");
}else
if(isset($_GET["onlystate"])){
    require_once ("../layout/oneEstadoGrid.php");
}else{
    echo "Elija un estado :)";
}
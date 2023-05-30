<?php

if(isset($_GET["states"])){
    require_once ("../layout/tablestates.php");
}else
if(isset($_GET["onlystate"])){
    require_once ("../layout/oneEstadoGrid.php");
}else
if(isset($_GET["onlysede"])){
    require_once ("../layout/onlySedesGrid.php");
}else{
    echo "Elija un estado :)";
}
<?php

include_once "../php/class/conx.php";
include_once "../php/class/personal.php" ;
include_once "../php/function/criptCodes.php" ;


$personal = new Personal($_GET['perfil']);

$SetName = $personal->getNombre();
$SetApellido = $personal->getApellido();
$SetCi = $personal->getCi();
$SetFecha = $personal->getFecha();
$SetGrado = $personal->getGrado();
$SetSexo = $personal->getSexo();
$SetIdCargo = $personal->getIdCargo();
$SetCargo = $personal->getCargo();
$SetPhone = $personal->getTelefono();
$SetEmail = $personal->getEmail();
$SetDireccion = $personal->getDireccion();
$SetEstado = $personal->getEstado();
$SetIdEstado = $personal->getIdEstado();
$SetCiudad = $personal->getCiudad();
$SetIdCiudad = $personal->getIdCiudad();
$SetSede = $personal->getSede();
$SetIdSede = $personal->getIdSede();
$SetDepart = $personal->getDepartament();
$SetIdDepart = $personal->getIdDepart();

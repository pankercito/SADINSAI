<?php

include_once("../php/class/personal.php");
include_once("../php/funtion/encriptDesencript.php");

 
$personal = new Personal($_GET['perfil']);

$SetName = $personal->getNombre();
$SetApellido = $personal->getApellido();
$SetCi = $personal->getCi();
$SetPhone = $personal->getTelefono();
$SetEmail =  $personal->getEmail();
$SetDireccion = $personal->getDireccion();
$SetEstado = $personal->getEstado();
$SetIdEstado = $personal->getIdEstado();
$SetCiudad = $personal->getCiudad();
$SetIdCiudad = $personal->getIdCiudad();
$SetSede = $personal->getSede();
$SetIdSede = $personal->getIdSede();


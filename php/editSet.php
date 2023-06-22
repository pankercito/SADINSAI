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
$SetIdEstado = $personal->getIdEstado();
$SetIdCiudad = $personal->getIdCiudad();
$SetIdSede = $personal->getIdSede();


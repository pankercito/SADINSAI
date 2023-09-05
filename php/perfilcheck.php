<?php
include("class/personal.php");

if (isset($_GET['perfil'])) {
    $personal = new Personal($_GET['perfil']);

    $pName = $personal->getNombre() . ' ' . $personal->getApellido();
    $pCi = $personal->getCi();
    $pPhone = $personal->getTelefono();
    $pEmail = $personal->getEmail();
    $pDireccion = $personal->getDireccion();
    $pStado = $personal->getEstado();
    $pCiudad = $personal->getCiudad();
    $pSede = $personal->getSede();
    $pCargo = $personal->getCargo();
} else {
    echo 'no llego esa mondaa';
}
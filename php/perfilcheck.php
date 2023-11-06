<?php
include("class/personal.php");

if (isset($_GET['perfil'])) {
    $personal = new Personal($_GET['perfil']);

    $pCi = $personal->getCi();
    $pName = $personal->getNombre() . ' ' . $personal->getApellido();
    $pSexo = $personal->getSexo();
    $pGrado = $personal->getGrado();
    $pFecha = $personal->getFecha();
    $pPhone = $personal->getTelefono();
    $pEmail = $personal->getEmail();
    $pDireccion = $personal->getDireccion();
    $pStado = $personal->getEstado();
    $pCiudad = $personal->getCiudad();
    $pSede = $personal->getSede();
    $pCargo = $personal->getCargo();
    $pDepart = $personal->getDepartament();
} else {
    echo 'no llego esa mondaa';
}
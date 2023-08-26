<?php

include("php/conx.php");
include("php/function/criptCodes.php");
include("php/class/personal.php");

$personal = new Personal("xeYwLF-N3YsQpEF0N0jJoQKBopenHcnblmuVQ1XfZUE");
    
    $pName = $personal->getNombre() . ' ' . $personal->getApellido();
    $pCi = $personal->getCi();
    $pPhone = $personal->getTelefono();
    $pEmail =  $personal->getEmail();
    $pDireccion = $personal->getDireccion();
    $pStado = $personal->getEstado();
    $pCiudad = $personal->getCiudad();

    echo $pCi;
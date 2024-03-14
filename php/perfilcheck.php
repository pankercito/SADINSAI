<?php

if (isset($_GET['perfil'])) {

    $personal = new Empleado($_GET['perfil']);
    $pesonaldata = $personal->getDetails();

    $pCi = $personal->ci;
    $pName = "$personal->nombre $personal->apellido";
    $pSexo = $pesonaldata->sexo;
    $pGrado = $pesonaldata->grado;
    $pFecha = $pesonaldata->fecha;
    $pPhone = $pesonaldata->telefono;
    $pEmail = $pesonaldata->email;
    $pDireccion = $pesonaldata->direccion;
    $pStado = $pesonaldata->estado;
    $pCiudad = $pesonaldata->ciudad;
    $pSede = $pesonaldata->sede;
    $pCargo = $pesonaldata->cargo;
    $pDepart = $pesonaldata->departamento;
} else {
    echo 'error al recibir datos';
}
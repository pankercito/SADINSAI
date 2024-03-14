<?php

$personal = new Empleado($_GET['perfil']);

$SetName = $personal->nombre;
$SetApellido = $personal->apellido;
$SetCi = $personal->ci;

$personal = $personal->getDetails();

$SetFecha = $personal->fecha;
$SetGrado = $personal->grado;
$SetSexo = $personal->sexo;
$SetIdCargo = $personal->idCargo;
$SetCargo = $personal->cargo;
$SetPhone = $personal->telefono;
$SetEmail = $personal->email;
$SetDireccion = $personal->direccion;
$SetEstado = $personal->estado;
$SetIdEstado = $personal->idEstado;
$SetCiudad = $personal->ciudad;
$SetIdCiudad = $personal->idCiudad;
$SetSede = $personal->sede;
$SetIdSede = $personal->idSede;
$SetDepart = $personal->departamento;
$SetIdDepart = $personal->idDepartamento;

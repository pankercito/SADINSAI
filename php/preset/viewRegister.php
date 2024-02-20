<?php

include "../class/classIncludes.php";
include "../function/criptCodes.php";

session_start();

$yo = $_SESSION['sesion'];

$auditoria = new GestionDeUsuarios();

$data = $auditoria->users($yo);

echo json_encode($data);
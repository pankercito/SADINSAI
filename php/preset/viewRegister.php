<?php

include('../conx.php');
include("../function/criptCodes.php");
include("../class/auditoria.php");

session_start();

$yo = $_SESSION['sesion'];

$auditoria = new auditoria();

$data = $auditoria->users($yo);

echo json_encode($data);
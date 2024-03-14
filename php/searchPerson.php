<?php

require "class/conx.php";
require "function/searchin.php";

$conn = new Conexion;

$keys = $conn->real_escape($_POST["keys"]);
$export = searching($keys, $conn);

echo json_encode($export);
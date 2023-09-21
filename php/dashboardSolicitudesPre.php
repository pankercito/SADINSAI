<?php

include("../php/conx.php");
include("../php/class/auditoria.php");
include("../php/function/sumarhora.php");

$new = new auditoria();

// definimos array de datos 
$json = $new->solicitudDetailstStats(date('y-m-d'));

// enviamos los datos como caden json
echo json_encode($json);
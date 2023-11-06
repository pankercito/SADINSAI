<?php

include("../php/conx.php");
include("../php/class/auditoria.php");
include("../php/function/sumarhora.php");

$new = new Auditoria();

// definimos array de datos 
$json = $new->solicitudDetailstStats(date('Y-m-d'));

// enviamos los datos como caden json
echo json_encode($json);
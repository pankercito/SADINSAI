<?php

if (isset($_POST["idSoli"])){
    
include('../conx.php');
include("../function/getESCname.php");

$conn = new Conexion();

    $subId  = $conn->real_escape($_POST["idSoli"]);
    
    $svp = $conn->query("SELECT * FROM precarga p INNER JOIN solicitudes s ON p.id_solicitud = s.id_solicitud WHERE p.id_solicitud = '$subId'");
    $sv = mysqli_num_rows($svp);
    
    if($sv == 1){
        $precarInf = mysqli_fetch_array($svp);
        $n = getNameEsc($precarInf['id_estado'], $precarInf['id_ciudad'], $precarInf['sede_id']);
        echo '
            <ul class="list-group-flush overflow-auto">
                <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <p class="por fw-bold">Cedula</p>
                    '. $precarInf['ci_solicitada'] .'
                </div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <p class="por fw-bold">Nombre</p>
                    '. ucwords(strtolower($precarInf['name'])) . '
                </div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <p class="por fw-bold">Apellido</p>
                    '. ucwords(strtolower($precarInf['apelido'])) . '
                </div>
                </li><li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <p class="por fw-bold">Direcci&oacute;n</p>
                    '. ucwords(strtolower($precarInf['direccion'])) . '
                </div>
                </li><li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <p class="por fw-bold">Estado</p>
                    '. ucwords(strtolower($n['estado'])) . '
                </div>
                </li><li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <p class="por fw-bold">Ciudad</p>
                    '. ucwords(strtolower($n['ciudad'])) . '
                </div>
                </li><li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <p class="por fw-bold">Sede</p>
                    '. ucwords(strtolower($n['sede'])) . '
                </div>
                </li><li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <p class="por fw-bold">Telefono</p>
                    '. $precarInf['telefono'] . '
                </div>
                </li><li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <p class="por fw-bold">email</p>
                    '. strtolower($precarInf['email']) . '
                </div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <p class="por fw-bold">Cargo</p>
                    '. $precarInf['cargo'] . '
                </div>
                </li>
            </ul>';
    }else{        
        echo "Error al consultar datos por favor intente más tarde";
    }    
}
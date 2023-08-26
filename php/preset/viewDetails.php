<?php

if (isset($_POST["idSoli"])){
    
include('../conx.php');

$conn = new Conexion();

    $subId  = $_POST["idSoli"];
    
    $svp = $conn->query("SELECT * FROM precarga p INNER JOIN solicitudes s ON p.id_solicitud = s.id_solicitud WHERE p.id_solicitud = '$subId'");
    $sv = mysqli_num_rows($svp);
    
    if($sv == 1){
        $lol = mysqli_fetch_array($svp);
        echo '
            <ul class="list-group-flush overflow-auto">
                <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold">Cedula</div>
                    '. $lol['ci_solicitada'] .'
                </div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold">Nombre</div>
                    '. ucwords(strtolower($lol['name'])) . '
                </div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold">Apellido</div>
                    '. ucwords(strtolower($lol['apelido'])) . '
                </div>
                </li><li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold">Direcci&oacute;n</div>
                    '. ucwords(strtolower($lol['direccion'])) . '
                </div>
                </li><li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold">Telefono</div>
                    '. $lol['telefono'] . '
                </div>
                </li><li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold">email</div>
                    '. strtolower($lol['email']) . '
                </div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold">Cargo</div>
                    '. $lol['cargo'] . '
                </div>
                </li>
            </ul>';
    }else{        
        echo "Error al consultar datos por favor intente más tarde";
    }    
}
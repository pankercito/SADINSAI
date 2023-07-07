<?php

if (isset($_POST["idSoli"])){
    
    require ("../conect.php");

    $subId  = mysqli_real_escape_string($connec, $_POST["idSoli"]);
    
    $svp = mysqli_query($connec, "SELECT * FROM precarga WHERE id_solicitud = '$subId'");
    $sv = mysqli_num_rows($svp);
    
    if($sv == 1){
        $lol = mysqli_fetch_array($svp);
        echo '
            <ul class="list-group-flush overflow-auto">
                <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold">Cedula</div>
                    '. $lol['ci'] . '
                </div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold">Nombre</div>
                    '. $lol['name'] . '
                </div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold">Apellido</div>
                    '. $lol['apelido'] . '
                </div>
                </li><li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold">Direcci&oacute;n</div>
                    '. $lol['direccion'] . '
                </div>
                </li><li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold">Telefono</div>
                    '. $lol['telefono'] . '
                </div>
                </li><li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold">email</div>
                    '. $lol['email'] . '
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
        echo "naonao";
    }    
}
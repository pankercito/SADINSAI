<?php

if (isset($_POST["idSoli"])){
    
    include("function/criptCodes.php");
    include("class/personal.php");
    require ("conx.php");

    if (isset($_POST['receptor'])) {

        $personal = new Personal($_POST['receptor']);
        
        $pName = $personal->getNombre();
        $pApellido = $personal->getApellido();
        $pCi = $personal->getCi();
        $pPhone = $personal->getTelefono();
        $pEmail =  $personal->getEmail();
        $pDireccion = $personal->getDireccion();
        $pStado = $personal->getEstado();
        $pCiudad = $personal->getCiudad();

        $conn = new Conexion;

        $subId  = $_POST["idSoli"];
        
        $svp = $conn->query( "SELECT * FROM precarga WHERE id_solicitud = '$subId'");
        $sv = mysqli_num_rows($svp);

        function viewMerge($vma, $vmb, $vmc){
            if($vma !== $vmb){
                $dad = $vmb . ' <i class="bi bi-arrow-right"></i> '. $vma;

                $vmca =  '<li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">'. $vmc .'</div>
                                '. $dad. '
                            </div>
                        </li>';
            }else{
               $vmca = '';
            }

            return $vmca;
        }
        
        if($sv == 1){
            $lol = mysqli_fetch_array($svp);

            $rst  = TRUE;
            //Li DE MUESTREO DE CAMBIOS'
            echo  '
                <h6 class="" style="margin: 0 0 1.2rem 6%;">Cambios realizados</h6>
                <ul class="list-group-flush overflow-auto">

                    '.viewMerge(ucwords(strtolower($lol['name'])), $pName, "Nombre").'

                    '.viewMerge(ucwords(strtolower($lol['apelido'])), $pApellido, "Apellido").'

                    '.viewMerge(ucwords(strtolower($lol['direccion'])), ucwords(strtolower($pDireccion)), "Direcci&oacute;n").'
                    
                    '.viewMerge($lol['telefono'], $pPhone, "Telefono").'
                    
                    '.viewMerge(ucwords(strtolower($lol['email'] )), ucwords(strtolower($pEmail)), "Email").'

                </ul>';
        }else{        
            echo "Error al consultar datos por favor intente más tarde";
        } 

        if($rst = TRUE){
            echo'
                <form action="../php/personalMerge.php" class="formgroup" id="soliMerge" method="POST">
                    <h6 class="" style="margin: 0 0 1.2rem 6%;">Por favor elija una opcion</h6>
                    <div class="form-check">
                        <input type="radio" class="btn-check"  name="editSoli" id="pendiente" value="0" checked>
                        <label for="pendiente" class="btn btn-outline-secondary">Pendiente</label>  
                    </div>
                    <div class="form-check">
                        <input type="radio" class="btn-check" name="editSoli" id="aceptar" value="1">
                        <label for="aceptar" class="btn btn-outline-success">Aceptar solicitud</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="btn-check" name="editSoli" id="rechazar" value="2">
                        <label for="rechazar" class="btn btn-outline-danger">Rechazar solicitud</label>  
                    </div>
                </form>';
        }

    }
} else {     
        echo "Error al consultar datos por favor intente más tarde";
} 
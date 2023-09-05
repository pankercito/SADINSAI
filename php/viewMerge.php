<?php

if (isset($_POST["idSoli"])) {

    include("function/criptCodes.php");
    include("function/getESCname.php");
    include("class/personal.php");
    require("conx.php");

    $conn = new Conexion();


    if (isset($_POST['receptor'])) {
        // obtener datos de la tabla principal para comparar 
        $personal = new Personal($conn->real_escape($_POST['receptor']));

        $pName = $personal->getNombre();
        $pApellido = $personal->getApellido();
        $pCi = $personal->getCi();
        $pPhone = $personal->getTelefono();
        $pEmail = $personal->getEmail();
        $pDireccion = $personal->getDireccion();
        $pStado = $personal->getEstado();
        $pCiudad = $personal->getCiudad();
        $pSede = $personal->getSede();
        $pCargo = $personal->getCargo();

        $conn = new Conexion;

        $subId = $_POST["idSoli"];

        $svp = $conn->query("SELECT * FROM precarga WHERE id_solicitud = '$subId'");
        $sv = mysqli_num_rows($svp);

        /**
         * Imprimir informes si los datos de entrada son diferentes
         * @param mixed $vma dato a
         * @param mixed $vmb dato b
         * @param mixed $vmc nombre de listado
         * @return string
         */
        function viewMerge($vma, $vmb, $vmc)
        {
            if ($vma !== $vmb) {
                $dad = $vmb . ' <i class="bi bi-arrow-right"></i> ' . $vma;

                $vmca = '<li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <p class="por fw-bold">' . $vmc . '</p>
                                ' . $dad . '
                            </div>
                        </li>';
            } else {
                $vmca = '';
            }

            return $vmca;
        }

        if ($sv == 1) {
            $precarInf = mysqli_fetch_array($svp);

            $ecs = getNameEsc($precarInf['id_estado'], $precarInf['id_ciudad'], $precarInf['sede_id']);


            //Lista DE MUESTREO DE CAMBIOS'
            echo '
                <h6 class="" style="margin: 0 0 1.2rem 6%;">Cambios realizados</h6>
                <ul class="list-group-flush overflow-auto">

                    ' . viewMerge(ucwords(strtolower($precarInf['name'])), $pName, "Nombre") . '

                    ' . viewMerge(ucwords(strtolower($precarInf['apelido'])), $pApellido, "Apellido") . '

                    ' . viewMerge(ucwords(strtolower($precarInf['direccion'])), ucwords(strtolower($pDireccion)), "Direcci&oacute;n") . '
                    
                    ' . viewMerge($precarInf['telefono'], $pPhone, "Telefono") . '
                    
                    ' . viewMerge(ucwords(strtolower($precarInf['email'])), ucwords(strtolower($pEmail)), "Email") . '

                    ' . viewMerge(ucwords(strtolower($ecs['estado'])), ucwords(strtolower($pStado)), "Estado") . '

                    ' . viewMerge(ucwords(strtolower($ecs['ciudad'])), ucwords(strtolower($pCiudad)), "Ciudad") . '

                    ' . viewMerge(ucwords(strtolower($ecs['sede'])), ucwords(strtolower($pSede)), "Sede") . '

                    ' . viewMerge(ucwords(strtolower($precarInf['cargo'])), ucwords(strtolower($pCargo)), "Cargo") . '



                </ul>';

            $rst = TRUE;
        } else {
            echo "Error al consultar datos por favor intente más tarde";
        }

        if ($rst = TRUE) {
            echo '
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
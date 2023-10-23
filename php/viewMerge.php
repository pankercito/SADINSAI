<?php

if (isset($_POST["idSoli"]) && isset($_POST['receptor'])) {

    include("function/criptCodes.php");
    include("function/getESCname.php");
    include("function/removerAcentos.php");
    include("class/personal.php");
    require("conx.php");

    $conn = new Conexion();
    $rst = false;

    switch ($_POST['receptor']) {
        case '0':
            // ingreso de personal
            $subId = $conn->real_escape($_POST["idSoli"]);

            $svp = $conn->query("SELECT * FROM solicitudes t
                                          INNER JOIN solicitudes_precarga p ON p.id_solicitud_precarga = t.id_solicitud 
                                          INNER JOIN estados e ON p.id_estado_pre = e.id_estado
                                          INNER JOIN ciudades c ON p.id_ciudad_pre = c.id_ciudad
                                          INNER JOIN sedes s ON p.id_sede_pre = s.sede_id
                                          INNER JOIN cargo g ON  p.cargo_pre = g.id_cargo
                                          INNER JOIN departamentos d ON p.departamento_pre = d.id_direccion
                                          WHERE t.id_solicitud = '$subId'");
            $sv = mysqli_num_rows($svp);


            $precarInf = mysqli_fetch_array($svp);

            $n = getNameEsc($precarInf['id_estado_pre'], $precarInf['id_ciudad_pre'], $precarInf['id_sede_pre']);

            if ($sv == 1) {
                function trPrint($vma, $vmc)
                {

                    $vmca =
                        '<tr class="imago">
                            <td scope="row"><p class="por fw-bold">' . $vmc . '</p></td>
                            <td></td>
                            <td>' . $vma . '</td>
                        </tr>';


                    return $vmca;
                }

                //Lista DE MUESTREO DE DATOS QUE INGRESARAN
                ?>
                <h4 class="" style="margin: 0 0 1.2rem 6%;">Ingreso de personal</h4>
                <div class="editConten row col-md-8">
                    <div class="col-md-8">
                        <form action="../php/personalMerge.php" class="formgroup" id="soliMerge" method="POST">
                            <h6 class="" style="margin: 0 0 1.2rem 11%;">Por favor elija una accion</h6>
                            <div class="form-check">
                                <input type="radio" class="btn-check" name="editSoli" id="pendiente" value="0" checked>
                                <label for="pendiente" class="rat btn btn-outline-secondary">Pendiente</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="btn-check" name="editSoli" id="aceptar" value="1">
                                <label for="aceptar" class="rat btn btn-outline-success">Aceptar solicitud</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="btn-check" name="editSoli" id="rechazar" value="2">
                                <label for="rechazar" class=" rat btn btn-outline-danger">Rechazar solicitud</label>
                            </div>
                        </form>
                    </div>
                    <div class="dit table-responsive">
                        <div class="contenedor">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Campo</th>
                                        <th></th>
                                        <th>Dato ingresado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    echo trPrint(ucwords($precarInf['ci_solicitada']), "Cedula");

                                    echo trPrint(ucwords(strtolower($precarInf['nombre_pre'])), "Nombre");

                                    echo trPrint(ucwords(strtolower($precarInf['apelido_pre'])), "Apellido");

                                    echo trPrint(ucwords(strtolower($precarInf['fecha_nac_pre'])), "Fecha de Nacimiento");

                                    echo trPrint(ucwords(strtolower($precarInf['grado_ac_pre'])), "Grado");

                                    echo trPrint(ucwords(strtolower($precarInf['direccion_pre'])), "Dirección");

                                    echo trPrint($precarInf['telefono_pre'], "Telefono");

                                    echo trPrint(strtolower($precarInf['email_pre']), "Email");
                                    
                                    echo trPrint(ucwords(strtolower(cor_acentos($n['estado']))), "Estado");
                                    
                                    echo trPrint(ucwords(strtolower(cor_acentos($n['ciudad']))), "Ciudad");
                                    
                                    echo trPrint(ucwords(strtolower(cor_acentos($n['sede']))), "Sede");
                                    
                                    echo trPrint(strtolower($precarInf['dir_nombre']), "Departamento");

                                    echo trPrint($precarInf['cargo_nombre'], "Cargo");

                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <style>
                            .dit img {
                                border-radius: 6px;
                                margin: 1rem 0;
                            }

                            .dit.table-responsive {
                                margin: 0 1rem 0px -4rem;
                            }

                            .paneldit {
                                margin: 0 0 0 13rem;
                            }

                            .editConten.row {
                                display: flex;
                                flex-wrap: nowrap;
                                margin: 2rem auto;
                                width: 64%;
                                align-items: flex-start;
                                justify-content: center;
                            }
                        </style>
                    </div>
                </div>

                <?php
            } else {
                echo "Error al consultar datos por favor intente más tarde" . $ciCrip;
            }
            break;

        case '1':
            // edicion de datos de personal

            $subId = $conn->real_escape($_POST["idSoli"]);

            $saralo = $conn->query("SELECT * FROM solicitudes t
                                          INNER JOIN solicitudes_precarga p ON p.id_solicitud_precarga = t.id_solicitud
                                          INNER JOIN cargo g ON g.id_cargo = p.cargo_pre
                                          INNER JOIN departamentos d ON d.id_direccion = p.departamento_pre
                                          WHERE t.id_solicitud = '$subId'");

            $sv = $saralo->num_rows;

            $precarInf = $saralo->fetch_assoc();

            // data vieja
            $personal = new Personal(encriptar($precarInf['ci_pre']));

            $pName = $personal->getNombre();
            $pApellido = $personal->getApellido();
            $pCi = $personal->getCi();
            $pPhone = $personal->getTelefono();
            $pSexo = $personal->getSexo();
            $pGrado = $personal->getGrado();
            $pEmail = $personal->getEmail();
            $pDireccion = $personal->getDireccion();
            $pStado = $personal->getEstado();
            $pCiudad = $personal->getCiudad();
            $pSede = $personal->getSede();
            $pCargo = $personal->getCargo();
            $pDepart = $personal->getDepartament();

            /**
             * Imprimir informes si los datos de entrada son diferentes
             * @param mixed $vma dato a nuevo dato
             * @param mixed $vmb dato b viejo dato
             * @param mixed $vmc nombre de listado
             * @return string
             */
            function viewMerge($vma, $vmb, $vmc)
            {
                if ($vma != $vmb) {
                    // tbla de datos 
                    $dad =
                        '<tr class="imago">
                            <td scope="row"><p class="por fw-bold">' . $vmc . '</p></td>
                            <td>' . $vmb . '</td>
                            <td><i class="bi bi-arrow-right"></i></td>
                            <td>' . $vma . ' </td>
                        </tr>';

                    $vmca = $dad;
                } else {
                    $vmca = '';
                }

                return $vmca;
            }


            if ($sv == 1) {

                $ecs = getNameEsc($precarInf['id_estado_pre'], $precarInf['id_ciudad_pre'], $precarInf['id_sede_pre']);

                //Lista DE MUESTREO DE CAMBIOS
                ?>
                <h4 class="" style="margin: 0 0 1.2rem 6%;">Cambios a Realizar</h4>
                <div class="editConten row col-md-8">
                    <div class="col-md-8">
                        <form action="../php/personalMerge.php" class="formgroup" id="soliMerge" method="POST">
                            <h6 class="" style="margin: 0 0 1.2rem 11%;">Por favor elija una accion</h6>
                            <div class="form-check">
                                <input type="radio" class="btn-check" name="editSoli" id="pendiente" value="0" checked>
                                <label for="pendiente" class="rat btn btn-outline-secondary">Pendiente</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="btn-check" name="editSoli" id="aceptar" value="1">
                                <label for="aceptar" class="rat btn btn-outline-success">Aceptar solicitud</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="btn-check" name="editSoli" id="rechazar" value="2">
                                <label for="rechazar" class=" rat btn btn-outline-danger">Rechazar solicitud</label>
                            </div>
                        </form>
                    </div>
                    <div class="dit table-responsive">
                        <h6 class="">
                            <p class="">edicion de datos de <a href="perfil.php?perfil=<?php echo encriptar($precarInf['ci_pre']) ?>">
                                    <?php echo $precarInf['ci_pre'] ?>
                                </a></p>
                        </h6>
                        <style>
                            .dit.table-responsive {
                                margin: 0 1rem 0px -4rem;
                            }

                            .paneldit {
                                margin: 0 0 0 13rem;
                            }

                            .editConten.row {
                                display: flex;
                                flex-wrap: nowrap;
                                margin: 2rem auto;
                                width: 64%;
                                align-items: flex-start;
                                justify-content: center;
                            }
                        </style>
                        <table class="table table-ligth">
                            <thead>
                                <tr>
                                    <th scope="col">campo</th>
                                    <th scope="col">antes</th>
                                    <th scope="col"></th>
                                    <th scope="col">despues</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                echo viewMerge(ucwords(strtolower($precarInf['nombre_pre'])), $pName, "Nombre");

                                echo viewMerge(ucwords(strtolower($precarInf['apelido_pre'])), $pApellido, "Apellido");

                                echo viewMerge(ucwords(strtolower($precarInf['sexo_pre'])), ucwords(strtolower($pSexo)), "Sexo");

                                echo viewMerge(ucwords(strtolower($precarInf['direccion_pre'])), ucwords(strtolower($pDireccion)), "Direcci&oacute;n");

                                echo viewMerge($precarInf['telefono_pre'], $pPhone, "Telefono");

                                echo viewMerge(ucwords(strtolower($precarInf['email_pre'])), ucwords(strtolower($pEmail)), "Email");

                                echo viewMerge(ucwords(strtolower($ecs['estado'])), ucwords(strtolower($pStado)), "Estado");

                                echo viewMerge(ucwords(strtolower($ecs['ciudad'])), ucwords(strtolower($pCiudad)), "Ciudad");

                                echo viewMerge(ucwords(strtolower($ecs['sede'])), ucwords(strtolower($pSede)), "Sede");

                                echo viewMerge(ucwords(strtolower($precarInf['cargo_nombre'])), ucwords(strtolower($pCargo)), "Cargo");

                                echo viewMerge(ucwords(strtolower($precarInf['dir_nombre'])), ucwords(strtolower($pDepart)), "Departamento");

                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <?php
            } else {
                echo "Error al consultar datos por favor intente más tarde" . $ciCrip;
            }

            break;
        case '2':
            // ingreso de archivos
            $subId = $conn->real_escape($_POST["idSoli"]);

            $svp = $conn->query("SELECT * FROM solicitudes s INNER JOIN solicitudes_archivos_precarga p INNER JOIN tiposarch t ON p.id_solicitud_archivo_pre = s.id_solicitud AND t.id_tipo = p.tipo_pre WHERE s.id_solicitud = '$subId'");
            $sv = mysqli_num_rows($svp);

            $precarInf = mysqli_fetch_array($svp);

            $tipoArch = $precarInf['nombre_tipo_arch'];

            $nota = ($precarInf['nota_pre'] == "") ? "sin nota" : $precarInf['nota_pre'];
            $c = $precarInf['size_pre'] / 1024;
            $size = ($c <= 920) ? number_format($c, 2) . "KB" : number_format($c / 1024, 2) . "MB";

            if ($sv == 1) {

                //Lista DE MUESTREO DE CAMBIOS
                ?>
                <h4 class="" style="margin: 0 0 1.2rem 6%;">Ingreso de archivos</h4>
                <div class="editConten row col-md-8">
                    <div class="col-md-8">
                        <form action="../php/personalMerge.php" class="formgroup" id="soliMerge" method="POST">
                            <h6 class="" style="margin: 0 0 1.2rem 11%;">Por favor elija una accion</h6>
                            <div class="form-check">
                                <input type="radio" class="btn-check" name="editSoli" id="pendiente" value="0" checked>
                                <label for="pendiente" class="rat btn btn-outline-secondary">Pendiente</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="btn-check" name="editSoli" id="aceptar" value="1">
                                <label for="aceptar" class="rat btn btn-outline-success">Aceptar solicitud</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="btn-check" name="editSoli" id="rechazar" value="2">
                                <label for="rechazar" class=" rat btn btn-outline-danger">Rechazar solicitud</label>
                            </div>
                        </form>
                    </div>
                    <div class="dit table-responsive">
                        <div class="">
                            <h6 class="">
                                <p style="font-size:15px;">subida de datos en el folder de: <a
                                        style="color: darkcyan; text-decoration: none;"
                                        href="perfil.php?perfil=<?php echo encriptar($precarInf['ci_arch_pre']) ?>">
                                        <?php echo $precarInf['ci_arch_pre'] ?>
                                    </a></p>
                            </h6>
                            <div class="row">
                                <div class="btn-toolbar d-grid gap-1" role="toolbar" aria-label="Toolbar">
                                    <div class="btn-group" role="group" aria-label="Button Group">
                                        <button class="btn btn-outline-primary" disabled>nombre del archivo:
                                            <?php echo $precarInf['nombre_archivo_pre'] ?>
                                        </button>
                                        <button class="btn btn-outline-primary" disabled>Archivo:
                                            <?php echo $tipoArch ?>
                                        </button>
                                    </div>
                                    <div class="btn-group" role="group" aria-label="Button Group">
                                        <button class="btn btn-outline-primary" disabled>peso:
                                            <?php echo $size ?>
                                        </button>
                                        <button class="btn btn-outline-primary" disabled>requerido:
                                            si
                                        </button>
                                        <button class="btn btn-outline-primary" disabled>nota:
                                            <?php echo $nota ?>
                                        </button>
                                    </div>
                                </div>

                            </div>
                            <img class="" src="<?php echo $precarInf['d_archivo_pre'] ?>" alt="Some text" width="200px">
                        </div>

                        <style>
                            .dit img {
                                border-radius: 6px;
                                margin: 1rem 0;
                            }

                            .dit.table-responsive {
                                margin: 0 1rem 0px -4rem;
                            }

                            .paneldit {
                                margin: 0 0 0 13rem;
                            }

                            .editConten.row {
                                display: flex;
                                flex-wrap: nowrap;
                                margin: 2rem auto;
                                width: 64%;
                                align-items: flex-start;
                                justify-content: center;
                            }
                        </style>
                    </div>
                </div>

                <?php
            } else {
                echo "Error al consultar datos por favor intente más tarde";
            }
            break;

        case '3':

            $id = $conn->real_escape($_POST["idSoli"]);

            @$x = $conn->query("SELECT * FROM solicitudes_eliminacion_arch e WHERE id_solicitud_eliminacion = '$id'");

            $idArch = $x->fetch_object()->id_archivo_eliminar;

            $verifi = $conn->query("SELECT * FROM archidata WHERE id_archivo = $idArch");

            if ($verifi->num_rows == 1) {

                $id_arch = $verifi->fetch_object()->id_archivo;

                $svp = $conn->query("SELECT * FROM solicitudes s INNER JOIN solicitudes_archivos_precarga p INNER JOIN tiposarch t ON p.id_solicitud_archivo_pre = s.id_solicitud AND t.id_tipo = p.tipo_pre WHERE s.id_solicitud = '$id_arch'");
                $sv = $svp->num_rows;

                $precarInf = mysqli_fetch_array($svp);

                $tipoArch = $precarInf['nombre_tipo_arch'];

                $nota = ($precarInf['nota_pre'] == "") ? "sin nota" : $precarInf['nota_pre'];
                $c = $precarInf['size_pre'] / 1024;
                $size = ($c <= 920) ? number_format($c, 2) . "KB" : number_format($c / 1024, 2) . "MB";


                //Lista DE MUESTREO DE CAMBIOS
                ?>
                <h4 class="" style="margin: 0 0 1.2rem 6%;">Eliminacion de archivo</h4>
                <div class="editConten row col-md-8">
                    <div class="col-md-8">
                        <form action="../php/personalMerge.php" class="formgroup" id="soliMerge" method="POST">
                            <h6 class="" style="margin: 0 0 1.2rem 11%;">Por favor elija una accion</h6>
                            <div class="form-check">
                                <input type="radio" class="btn-check" name="editSoli" id="pendiente" value="0" checked>
                                <label for="pendiente" class="rat btn btn-outline-secondary">Pendiente</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="btn-check" name="editSoli" id="aceptar" value="1">
                                <label for="aceptar" class="rat btn btn-outline-success">Aceptar solicitud</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="btn-check" name="editSoli" id="rechazar" value="2">
                                <label for="rechazar" class=" rat btn btn-outline-danger">Rechazar solicitud</label>
                            </div>
                        </form>
                    </div>
                    <div class="dit table-responsive">
                        <div class="">
                            <h6 class="">
                                <p style="font-size:15px;">datos del folder de: <a style="color: darkcyan; text-decoration: none;"
                                        href="perfil.php?perfil=<?php echo encriptar($precarInf['ci_arch_pre']) ?>">
                                        <?php echo $precarInf['ci_arch_pre'] ?>
                                    </a></p>
                            </h6>
                            <div class="row">
                                <div class="btn-toolbar d-grid gap-1" role="toolbar" aria-label="Toolbar">
                                    <div class="btn-group" role="group" aria-label="Button Group">
                                        <button class="btn btn-outline-primary" disabled>nombre del archivo:
                                            <?php echo $precarInf['nombre_archivo_pre'] ?>
                                        </button>
                                        <button class="btn btn-outline-primary" disabled>Archivo:
                                            <?php echo $tipoArch ?>
                                        </button>
                                    </div>
                                    <div class="btn-group" role="group" aria-label="Button Group">
                                        <button class="btn btn-outline-primary" disabled>peso:
                                            <?php echo $size ?>
                                        </button>
                                        <button class="btn btn-outline-primary" disabled>requerido:
                                            si
                                        </button>
                                        <button class="btn btn-outline-primary" disabled>nota:
                                            <?php echo $nota ?>
                                        </button>
                                    </div>
                                </div>

                            </div>
                            <img class="" src="<?php echo $precarInf['d_archivo_pre'] ?>" alt="Some text" width="200px">
                        </div>

                        <style>
                            .dit img {
                                border-radius: 6px;
                                margin: 1rem 0;
                            }

                            .dit.table-responsive {
                                margin: 0 1rem 0px -4rem;
                            }

                            .paneldit {
                                margin: 0 0 0 13rem;
                            }

                            .editConten.row {
                                display: flex;
                                flex-wrap: nowrap;
                                margin: 2rem auto;
                                width: 64%;
                                align-items: flex-start;
                                justify-content: center;
                            }
                        </style>
                    </div>
                </div>

                <?php
            } else {
                echo "el archivo no existe o ya fue eliminado";
            }

            break;

        default:
            # code...
            break;
    }


}
<?php

if (isset($_POST["idSoli"])) {

    include('../conx.php');
    include("../function/getESCname.php");
    include("../function/criptCodes.php");

    $conn = new Conexion();

    switch ($_POST['tipoSoli']) {
        case 0:
            $subId = $conn->real_escape($_POST["idSoli"]);

            $svp = $conn->query("SELECT * FROM solicitudes s INNER JOIN solicitudes_precarga p ON p.id_solicitud_precarga = s.id_solicitud WHERE s.id_solicitud = '$subId'");
            $sv = mysqli_num_rows($svp);

            if ($sv == 1) {
                $precarInf = mysqli_fetch_array($svp);
                $n = getNameEsc($precarInf['id_estado_pre'], $precarInf['id_ciudad_pre'], $precarInf['id_sede_pre']);
                echo '
                <h4 class="text-star p-2 mx-4">Ingreso de personal</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Cedula</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Direccion</th>
                                <th>Estado</th>
                                <th>Ciudad</th>
                                <th>Sede</th>
                                <th>Telefono</th>
                                <th>email</th>
                                <th>Cargo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>' . $precarInf['ci_solicitada'] . '</td>
                                <td>' . ucwords(strtolower($precarInf['nombre_pre'])) . '</td>
                                <td>' . ucwords(strtolower($precarInf['apelido_pre'])) . '</td>
                                <td>' . ucwords(strtolower($precarInf['direccion_pre'])) . '</td>
                                <td>' . ucwords(strtolower($n['estado'])) . '</td>
                                <td>' . ucwords(strtolower($n['ciudad'])) . '</td>
                                <td>' . ucwords(strtolower($n['sede'])) . '</td>
                                <td>' . $precarInf['telefono_pre'] . '</td>
                                <td>' . strtolower($precarInf['email_pre']) . '</td>
                                <td>' . $precarInf['cargo_pre'] . '</td>
                            </tr>
                        </tbody>
                    </table>';
            } else {
                echo "Error al consultar datos por favor intente más tarde";
            }
            break;

        case 1:
            $subId = $conn->real_escape($_POST["idSoli"]);

            $svp = $conn->query("SELECT * FROM solicitudes s INNER JOIN solicitudes_precarga p ON p.id_solicitud_precarga = s.id_solicitud WHERE s.id_solicitud = '$subId'");
            $sv = mysqli_num_rows($svp);

            if ($sv == 1) {
                $precarInf = mysqli_fetch_array($svp);
                $n = getNameEsc($precarInf['id_estado_pre'], $precarInf['id_ciudad_pre'], $precarInf['id_sede_pre']);
                echo '
                <h4 class="text-star p-2 mx-4">Nueva informacion</h4>
            <ul class="list-group-flush overflow-auto">
                <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <p class="por fw-bold">Cedula</p>
                    ' . $precarInf['ci_solicitada'] . '
                </div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <p class="por fw-bold">Nombre</p>
                    ' . ucwords(strtolower($precarInf['nombre_pre'])) . '
                </div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <p class="por fw-bold">Apellido</p>
                    ' . ucwords(strtolower($precarInf['apelido_pre'])) . '
                </div>
                </li><li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <p class="por fw-bold">Direcci&oacute;n</p>
                    ' . ucwords(strtolower($precarInf['direccion_pre'])) . '
                </div>
                </li><li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <p class="por fw-bold">Estado</p>
                    ' . ucwords(strtolower($n['estado'])) . '
                </div>
                </li><li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <p class="por fw-bold">Ciudad</p>
                    ' . ucwords(strtolower($n['ciudad'])) . '
                </div>
                </li><li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <p class="por fw-bold">Sede</p>
                    ' . ucwords(strtolower($n['sede'])) . '
                </div>
                </li><li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <p class="por fw-bold">Telefono</p>
                    ' . $precarInf['telefono_pre'] . '
                </div>
                </li><li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <p class="por fw-bold">email</p>
                    ' . strtolower($precarInf['email_pre']) . '
                </div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <p class="por fw-bold">Cargo</p>
                    ' . $precarInf['cargo_pre'] . '
                </div>
                </li>
            </ul>';
            } else {
                echo "Error al consultar datos por favor intente más tarde";
            }
            break;
        case '2':
            // ingreso de archivos
            $subId = $conn->real_escape($_POST["idSoli"]);

            $svp = $conn->query("SELECT * FROM solicitudes s INNER JOIN solicitudes_archivos_precarga p INNER JOIN tiposarch t ON p.id_solicitud_archivo_pre = s.id_solicitud AND t.id_tipo = p.tipo_pre WHERE s.id_solicitud = '$subId'");
            $sv = mysqli_num_rows($svp);

            $precarInf = mysqli_fetch_assoc($svp);

            @$tipoArch = $precarInf['nombre_tipo_arch'];

            @$nota = ($precarInf['nota_pre'] == "") ? "sin nota" : $precarInf['nota_pre'];
            @$c = $precarInf['size_pre'] / 1024;
            $size = ($c <= 920) ? number_format($c, 2) . "KB" : number_format($c / 1024, 2) . "MB";

            if ($sv == 1) {
                //DETALLES DE ARCHIVO SUBIDO
                ?>
                <h4 class="" style="margin: 0 0 1.2rem 6%;">Ingreso de archivos</h4>
                <div class="editConten row col-md-8">
                    <div class="dit">
                        <div class="caram">
                            <div class="row">
                                <div class="btn-toolbar d-grid gap-1" role="toolbar" aria-label="Toolbar">
                                    <div class="btn-group" role="group" aria-label="Button Group">
                                        <button class="btn btn-outline-primary" disabled>nombre del archivo:
                                            <?php echo $precarInf['nombre_archivo_pre'] ?>
                                        </button>
                                        <button class="btn btn-outline-primary" disabled>Archivo:
                                            <?php echo $tipoArch ?>
                                        </button>
                                        <a class="btn btn-outline-primary"
                                            href="perfil.php?perfil=<?php echo encriptar($precarInf['ci_arch_pre']) ?>&parce=true">carpeta
                                            de :
                                            <?php echo $precarInf['ci_arch_pre'] ?>
                                        </a>
                                    </div>
                                    <div class="btn-group" role="group" aria-label="Button Group">
                                        <button class="btn btn-outline-primary" disabled>peso:
                                            <?php echo $size ?>
                                        </button>
                                        <button class="btn btn-outline-primary" disabled>requerido:
                                            requerido: si
                                        </button>
                                        <button class="btn btn-outline-primary" disabled>nota:
                                            <?php echo $nota ?>
                                        </button>
                                    </div>
                                </div>

                            </div>
                            <img class="" src="<?php echo $precarInf['d_archivo_pre'] ?>" alt="Some text" width="200px">
                        </div>
                    </div>
                    <style>
                        .dit img {
                            border-radius: 6px;
                            margin: 1rem 0;
                        }
                    </style>
                </div>

                <?php
            } else {
                echo "Error al consultar datos por favor intente más tarde";
            }
            break;
        case '3':
            // eliminacion de archivos
            $id = $conn->real_escape($_POST["idSoli"]);

            @$x = $conn->query("SELECT * FROM solicitudes_eliminacion_arch e WHERE id_solicitud_eliminacion = '$id'");
            
            $subId = $x->fetch_object()->id_archivo_eliminar;
            
            $svp = $conn->query("SELECT * FROM solicitudes s INNER JOIN solicitudes_archivos_precarga p INNER JOIN tiposarch t ON p.id_solicitud_archivo_pre = s.id_solicitud AND t.id_tipo = p.tipo_pre WHERE s.id_solicitud = '$subId'");
            $sv = mysqli_num_rows($svp);

            $precarInf = mysqli_fetch_assoc($svp);

            @$tipoArch = $precarInf['nombre_tipo_arch'];

            @$nota = ($precarInf['nota_pre'] == "") ? "sin nota" : $precarInf['nota_pre'];
            @$c = $precarInf['size_pre'] / 1024;
            $size = ($c <= 920) ? number_format($c, 2) . "KB" : number_format($c / 1024, 2) . "MB";

            if ($sv == 1) {
                //DETALLES DE ARCHIVO SUBIDO
                ?>
                <h4 class="" style="margin: 0 0 1.2rem 6%;">eliminacion de archivo de archivos</h4>
                <div class="editConten row col-md-8">
                    <div class="dit">
                        <div class="caram">
                            <div class="row">
                                <div class="btn-toolbar d-grid gap-1" role="toolbar" aria-label="Toolbar">
                                    <div class="btn-group" role="group" aria-label="Button Group">
                                        <button class="btn btn-outline-primary" disabled>nombre del archivo:
                                            <?php echo $precarInf['nombre_archivo_pre'] ?>
                                        </button>
                                        <button class="btn btn-outline-primary" disabled>Archivo:
                                            <?php echo $tipoArch ?>
                                        </button>
                                        <a class="btn btn-outline-primary"
                                            href="perfil.php?perfil=<?php echo encriptar($precarInf['ci_arch_pre']) ?>&parce=true">carpeta
                                            de :
                                            <?php echo $precarInf['ci_arch_pre'] ?>
                                        </a>
                                    </div>
                                    <div class="btn-group" role="group" aria-label="Button Group">
                                        <button class="btn btn-outline-primary" disabled>peso:
                                            <?php echo $size ?>
                                        </button>
                                        <button class="btn btn-outline-primary" disabled>requerido:
                                            requerido: si
                                        </button>
                                        <button class="btn btn-outline-primary" disabled>nota:
                                            <?php echo $nota ?>
                                        </button>
                                    </div>
                                </div>

                            </div>
                            <img class="" src="<?php echo $precarInf['d_archivo_pre'] ?>" alt="Some text" width="200px">
                        </div>
                    </div>
                    <style>
                        .dit img {
                            border-radius: 6px;
                            margin: 1rem 0;
                        }
                    </style>
                </div>

                <?php
            } else {
                echo "Error al encontrar el Archivo o Archivo eliminado";
            }
            break;

        default:
            # code...
            break;
    }

}
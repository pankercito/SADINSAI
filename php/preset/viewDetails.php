<?php

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

if (isset($_POST["idSoli"])) {

    include "../class/conx.php";
    include "../function/getESCname.php";
    include "../function/criptCodes.php";

    $conn = new Conexion();

    switch ($_POST['tipoSoli']) {
        case 0:
            $subId = $conn->real_escape($_POST["idSoli"]);

            $svp = $conn->query("SELECT * FROM solicitudes t 
                                          INNER JOIN solicitudes_precarga p ON p.id_solicitud_precarga = t.id_solicitud 
                                          INNER JOIN estados e ON p.id_estado_pre = e.id_estado
                                          INNER JOIN ciudades c ON p.id_ciudad_pre = c.id_ciudad
                                          INNER JOIN sedes s ON p.id_sede_pre = s.sede_id
                                          INNER JOIN cargo g ON  p.cargo_pre = g.id_cargo
                                          INNER JOIN departamentos d ON p.departamento_pre = d.id_direccion
                                          WHERE t.id_solicitud = '$subId'");

            $sv = $svp->num_rows;

            if ($sv > 0) {

                $precarInf = mysqli_fetch_array($svp);
                $n = getNameEsc($precarInf['id_estado_pre'], $precarInf['id_ciudad_pre'], $precarInf['id_sede_pre']);

                ?>

                <h4 class="text-star p-2 mx-4">Ingreso de personal</h4>
                <hr>
                <div class="dit mx-auto table-responsive">
                    <div class="contenedor col-md-8 mx-auto mt-4">
                        <table class="table table">
                            <thead>
                                <tr>
                                    <th>CAMPO</th>
                                    <th></th>
                                    <th>DATO INGRESADO</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                echo trPrint(ucwords($precarInf['ci_solicitada']), "cedula");

                                echo trPrint(ucwords(strtolower($precarInf['nombre_pre'])), "nombre");

                                echo trPrint(ucwords(strtolower($precarInf['apelido_pre'])), "apellido");

                                echo trPrint(ucwords(strtolower($precarInf['fecha_nac_pre'])), "fecha de nacimiento");

                                echo trPrint(ucwords(strtolower($precarInf['grado_ac_pre'])), "grado");

                                echo trPrint(ucwords(strtolower($precarInf['sexo_pre'])), "sexo");

                                echo trPrint(ucwords(strtolower($precarInf['direccion_pre'])), "direcci&oacute;n");

                                echo trPrint($precarInf['telefono_pre'], "telefono");

                                echo trPrint(strtolower($precarInf['email_pre']), "email");

                                echo trPrint(ucwords(strtolower($n['estado'])), "estado");

                                echo trPrint(ucwords(strtolower($n['ciudad'])), "ciudad");

                                echo trPrint(ucwords(strtolower($n['sede'])), "sede");

                                echo trPrint(ucwords(strtolower($precarInf['dir_nombre'])), "departamento");

                                echo trPrint($precarInf['cargo_nombre'], "cargo");

                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php

            } else {
                echo "Error al consultar datos por favor intente más tarde";
            }
            break;

        case 1:
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

            if ($sv == 1) {
                $precarInf = mysqli_fetch_array($svp);
                $n = getNameEsc($precarInf['id_estado_pre'], $precarInf['id_ciudad_pre'], $precarInf['id_sede_pre']);
                
                ?>

                <h4 class="text-star p-2 mx-4">Edicion de datos: Nueva informacion</h4>
                <hr>
                <div class="dit mx-auto table-responsive">
                    <div class="contenedor col-md-10 mx-auto mt-4">
                        <?php echo "Dirigido a: " . $precarInf['ci_solicitada'] ?>
                        <table class="table table-primary">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>CAMPO</th>
                                    <th></th>
                                    <th>ACTUALIZADO A</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                echo trPrint(ucwords(strtolower($precarInf['nombre_pre'])), "nombre");

                                echo trPrint(ucwords(strtolower($precarInf['apelido_pre'])), "apellido");

                                echo trPrint(ucwords(strtolower($precarInf['fecha_nac_pre'])), "fecha de nacimiento");

                                echo trPrint(ucwords(strtolower($precarInf['grado_ac_pre'])), "grado");

                                echo trPrint(ucwords(strtolower($precarInf['sexo_pre'])), "sexo");

                                echo trPrint(ucwords(strtolower($precarInf['direccion_pre'])), "direcci&oacute;n");

                                echo trPrint($precarInf['telefono_pre'], "telefono");

                                echo trPrint(strtolower($precarInf['email_pre']), "email");

                                echo trPrint(ucwords(strtolower($n['estado'])), "estado");

                                echo trPrint(ucwords(strtolower($n['ciudad'])), "ciudad");

                                echo trPrint(ucwords(strtolower($n['sede'])), "sede");

                                echo trPrint(ucwords(strtolower($precarInf['dir_nombre'])), "departamento");

                                echo trPrint($precarInf['cargo_nombre'], "cargo");

                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php
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
                <hr>
                <div class="editConten row mx-auto mt-4 col-md-8">
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
                                            de:
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
                            <img class="mx-auto" src="<?php echo $precarInf['d_archivo_pre'] ?>" alt="Some text" width="200px">
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
                <h4 class="" style="margin: 0 0 1.2rem 6%;">Eliminacion de archivos</h4>
                <hr>
                <div class="editConten mx-auto mt-5 row col-md-8">
                    <div class="dit">
                        <div class="caram">
                            <div class="row">
                                <div class="btn-toolbar d-grid gap-1" role="toolbar" aria-label="Toolbar">
                                    <div class="btn-group" role="group" aria-label="Button Group">
                                        <button class="btn btn-outline-danger" disabled>nombre del archivo:
                                            <?php echo $precarInf['nombre_archivo_pre'] ?>
                                        </button>
                                        <button class="btn btn-outline-danger" disabled>Archivo:
                                            <?php echo $tipoArch ?>
                                        </button>
                                        <a class="btn btn-outline-danger"
                                            href="perfil.php?perfil=<?php echo encriptar($precarInf['ci_arch_pre']) ?>&parce=true">carpeta
                                            de:
                                            <?php echo $precarInf['ci_arch_pre'] ?>
                                        </a>
                                    </div>
                                    <div class="btn-group" role="group" aria-label="Button Group">
                                        <button class="btn btn-outline-danger" disabled>peso:
                                            <?php echo $size ?>
                                        </button>
                                        <button class="btn btn-outline-danger" disabled>requerido:
                                            requerido: si
                                        </button>
                                        <button class="btn btn-outline-danger" disabled>nota:
                                            <?php echo $nota ?>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <img class="mx-auto" src="<?php echo $precarInf['d_archivo_pre'] ?>" alt="Some text" width="200px">
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
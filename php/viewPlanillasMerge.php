<?php

if (isset($_POST["idSoli"]) && isset($_POST['tipoSoli'])) {

    require("conx.php");
    include("function/criptCodes.php");
    include("function/getESCname.php");
    include("function/removerAcentos.php");
    include("class/personal.php");
    include("class/solicitudes.php");

    $conn = new Conexion();

    $conn = new Conexion();

    $id = $conn->real_escape($_POST['idSoli']);
    $tipoSoli = $conn->real_escape($_POST['tipoSoli']);


    $tipo = [
        '1' => "anticipo",
        '2' => "permiso",
        '3' => "vacaciones",
        '4' => "carta de aval",
        '5' => "licencia de paternidad"
    ];

    switch ($tipoSoli) {
        case '1':
            $ver = solicitudes::ObtenerSolicitud($id);

            $corgale = $ver->DetallePLanillas();

            $printcito = $corgale[0];


            $nombres = array_keys($printcito);

            ?>
            <h4 class="text-center">Detalles de Solicitud</h4>
            <hr>
            <div class="col d-flex flex-row">
                <div class="col-4 radios">
                    <h6 style="margin: 0 0 1.2rem 11%;">Por favor elija una accion</h6>
                    <div class="form-check">
                        <input type="radio" class="btn-check" name="editSoli" id="pendiente" value="0" checked>
                        <label for="pendiente" class="rat btn btn-outline-secondary">Pendiente</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="btn-check" name="editSoli" id="aceptar" value="1">
                        <label for="aceptar" class="rat btn btn-outline-success">Aceptar solicitud</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="btn-check" name="editSoli" id="rechazar" value="2" data-bs-toggle="collapse"
                            data-bs-target="#contentId" aria-expanded="false" aria-controls="contentId">
                        <label for="rechazar" class=" rat btn btn-outline-danger">Rechazar solicitud</label>
                        <div class="collapse" id="contentId">
                            <div class="mb-3">
                                <label for="movito" class="form-label" id="colored">motivo</label>
                                <input type="text" class="form-control" name="movito" id="movito" aria-describedby="helpId"
                                    placeholder="texto">
                                <small id="helpId" class="form-text text-muted">ingrese el motivo de rechazo</small>
                            </div>
                        </div>
                    </div>
                    <style>
                        #colored {
                            background: none;
                            margin: 10px 0 0 0;
                            display: block;
                            position: relative;
                            padding: 0 0 0 0;
                            height: auto;
                        }
                    </style>
                </div>
                <div class="col-7">
                    <?php echo "<h6 class='text-center'>tipo de solicitud: " . $tipo[$tipoSoli] . "</h6>"; ?>
                    <div class="mx-auto">
                        <table class="table table-info">
                            <tbody>
                                <?php
                                foreach ($nombres as $key) {
                                    echo '
                                <tr class="primary">
                                    <th  scope="row">' . $key . '</th>
                                    </tr>
                                <tr>
                                    <td scope="row">' . $printcito[$key] . '</td>
                                </tr>  ';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- //PERMISO DE IMPRESION -->
            <input type="text" class="d-none" value="<?php echo $corgale[0][0] ?>" id="coco">
            <?php
            break;
        case '2':
            $ver = solicitudes::ObtenerSolicitud($id);

            $vear = $ver->Detalles();

            $printcito = [];
            foreach ($vear as $key => $value) {
                foreach ($value as $ky => $le) {
                    if ($ky == "data_solicitudes") {
                        foreach ($le as $kw) {
                            $assocs = trim(explode(':', $kw)[0]);
                            $valorcitos = trim(explode(':', $kw)[1]);

                            $printcito[$assocs] = $valorcitos;
                        }
                    }
                    if ($ky == "estado_permiso") {
                        $verificacionDestado = $le;
                    }
                }
            }

            $nombres = array_keys($printcito);

            ?>
            <h4 class="text-center">Detalles de Solicitud</h4>
            <hr>
            <div class="col d-flex flex-row">
                <div class="col-4 radios">
                    <h6 style="margin: 0 0 1.2rem 11%;">Por favor elija una accion</h6>
                    <div class="form-check">
                        <input type="radio" class="btn-check" name="editSoli" id="pendiente" value="0" checked>
                        <label for="pendiente" class="rat btn btn-outline-secondary">Pendiente</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="btn-check" name="editSoli" id="aceptar" value="1">
                        <label for="aceptar" class="rat btn btn-outline-success">Aceptar solicitud</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="btn-check" name="editSoli" id="rechazar" value="2" data-bs-toggle="collapse"
                            data-bs-target="#contentId" aria-expanded="false" aria-controls="contentId">
                        <label for="rechazar" class=" rat btn btn-outline-danger">Rechazar solicitud</label>
                        <div class="collapse" id="contentId">
                            <div class="mb-3">
                                <label for="movito" class="form-label" id="colored">motivo</label>
                                <input type="text" class="form-control" name="movito" id="movito" aria-describedby="helpId"
                                    placeholder="texto">
                                <small id="helpId" class="form-text text-muted">ingrese el motivo de rechazo</small>
                            </div>
                        </div>
                    </div>
                    <style>
                        #colored {
                            background: none;
                            margin: 10px 0 0 0;
                            display: block;
                            position: relative;
                            padding: 0 0 0 0;
                            height: auto;
                        }
                    </style>
                </div>
                <div class="col-7">
                    <?php echo "<h6 class='text-center'>tipo de solicitud: " . $tipo[$tipoSoli] . "</h6>"; ?>
                    <div class="mx-auto">
                        <table class="table table-info">
                            <tbody>
                                <?php
                                foreach ($nombres as $key) {
                                    echo '
                                <tr class="primary">
                                    <th  scope="row">' . $key . '</th>
                                    </tr>
                                <tr>
                                    <td scope="row">' . $printcito[$key] . '</td>
                                </tr>  ';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- //PERMISO DE IMPRESION -->
            <input type="text" class="d-none" value="<?php echo $verificacionDestado ?>" id="coco">
            <?php
            break;
        case '3':
            $ver = solicitudes::ObtenerSolicitud($id);

            $vear = $ver->Detalles();

            $printcito = [];
            foreach ($vear as $key => $value) {
                foreach ($value as $ky => $le) {
                    if ($ky == "data_solicitudes") {
                        foreach ($le as $kw) {
                            $assocs = trim(explode(':', $kw)[0]);
                            $valorcitos = trim(explode(':', $kw)[1]);

                            $printcito[$assocs] = $valorcitos;
                        }
                    }
                    if ($ky == "estado_permiso") {
                        $verificacionDestado = $le;
                    }
                }
            }

            $nombres = array_keys($printcito);

            ?>
            <h4 class="text-center">Detalles de Solicitud</h4>
            <hr>
            <div class="col d-flex flex-row">
                <div class="col-4 radios">
                    <h6 style="margin: 0 0 1.2rem 11%;">Por favor elija una accion</h6>
                    <div class="form-check">
                        <input type="radio" class="btn-check" name="editSoli" id="pendiente" value="0" checked>
                        <label for="pendiente" class="rat btn btn-outline-secondary">Pendiente</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="btn-check" name="editSoli" id="aceptar" value="1">
                        <label for="aceptar" class="rat btn btn-outline-success">Aceptar solicitud</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="btn-check" name="editSoli" id="rechazar" value="2" data-bs-toggle="collapse"
                            data-bs-target="#contentId" aria-expanded="false" aria-controls="contentId">
                        <label for="rechazar" class=" rat btn btn-outline-danger">Rechazar solicitud</label>
                        <div class="collapse" id="contentId">
                            <div class="mb-3">
                                <label for="movito" class="form-label" id="colored">motivo</label>
                                <input type="text" class="form-control" name="movito" id="movito" aria-describedby="helpId"
                                    placeholder="texto">
                                <small id="helpId" class="form-text text-muted">ingrese el motivo de rechazo</small>
                            </div>
                        </div>
                    </div>
                    <style>
                        #colored {
                            background: none;
                            margin: 10px 0 0 0;
                            display: block;
                            position: relative;
                            padding: 0 0 0 0;
                            height: auto;
                        }
                    </style>
                </div>
                <div class="col-7">
                    <?php echo "<h6 class='text-center'>tipo de solicitud: " . $tipo[$tipoSoli] . "</h6>"; ?>
                    <div class="mx-auto">
                        <table class="table table-info">
                            <tbody>
                                <?php
                                foreach ($nombres as $key) {
                                    echo '
                                <tr class="primary">
                                    <th  scope="row">' . $key . '</th>
                                    </tr>
                                <tr>
                                    <td scope="row">' . $printcito[$key] . '</td>
                                </tr>  ';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- //PERMISO DE IMPRESION -->
            <input type="text" class="d-none" value="<?php echo $verificacionDestado ?>" id="coco">
            <?php
            break;
        case '4':
            $ver = solicitudes::ObtenerSolicitud($id);

            $vear = $ver->Detalles();

            $printcito = [];
            foreach ($vear as $key => $value) {
                foreach ($value as $ky => $le) {
                    if ($ky == "data_solicitudes") {
                        foreach ($le as $kw) {
                            $assocs = trim(explode(':', $kw)[0]);
                            $valorcitos = trim(explode(':', $kw)[1]);

                            $printcito[$assocs] = $valorcitos;
                        }
                    }
                    if ($ky == "estado_permiso") {
                        $verificacionDestado = $le;
                    }
                }
            }

            $nombres = array_keys($printcito);

            ?>
            <h4 class="text-center">Detalles de Solicitud</h4>
            <hr>
            <div class="col d-flex flex-row">
                <div class="col-4 radios">
                    <h6 style="margin: 0 0 1.2rem 11%;">Por favor elija una accion</h6>
                    <div class="form-check">
                        <input type="radio" class="btn-check" name="editSoli" id="pendiente" value="0" checked>
                        <label for="pendiente" class="rat btn btn-outline-secondary">Pendiente</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="btn-check" name="editSoli" id="aceptar" value="1">
                        <label for="aceptar" class="rat btn btn-outline-success">Aceptar solicitud</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="btn-check" name="editSoli" id="rechazar" value="2" data-bs-toggle="collapse"
                            data-bs-target="#contentId" aria-expanded="false" aria-controls="contentId">
                        <label for="rechazar" class=" rat btn btn-outline-danger">Rechazar solicitud</label>
                        <div class="collapse" id="contentId">
                            <div class="mb-3">
                                <label for="movito" class="form-label" id="colored">motivo</label>
                                <input type="text" class="form-control" name="movito" id="movito" aria-describedby="helpId"
                                    placeholder="texto">
                                <small id="helpId" class="form-text text-muted">ingrese el motivo de rechazo</small>
                            </div>
                        </div>
                    </div>
                    <style>
                        #colored {
                            background: none;
                            margin: 10px 0 0 0;
                            display: block;
                            position: relative;
                            padding: 0 0 0 0;
                            height: auto;
                        }
                    </style>
                </div>
                <div class="col-7">
                    <?php echo "<h6 class='text-center'>tipo de solicitud: " . $tipo[$tipoSoli] . "</h6>"; ?>
                    <div class="mx-auto">
                        <table class="table table-info">
                            <tbody>
                                <?php
                                foreach ($nombres as $key) {
                                    echo '
                                <tr class="primary">
                                    <th  scope="row">' . $key . '</th>
                                    </tr>
                                <tr>
                                    <td scope="row">' . $printcito[$key] . '</td>
                                </tr>  ';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- //PERMISO DE IMPRESION -->
            <input type="text" class="d-none" value="<?php echo $verificacionDestado ?>" id="coco">
            <?php
            break;
        case '5':
            $ver = solicitudes::ObtenerSolicitud($id);

            $vear = $ver->Detalles();

            $printcito = [];
            foreach ($vear as $key => $value) {
                foreach ($value as $ky => $le) {
                    if ($ky == "data_solicitudes") {
                        foreach ($le as $kw) {
                            $assocs = trim(explode(':', $kw)[0]);
                            $valorcitos = trim(explode(':', $kw)[1]);

                            $printcito[$assocs] = $valorcitos;
                        }
                    }
                    if ($ky == "estado_permiso") {
                        $verificacionDestado = $le;
                    }
                }
            }

            $nombres = array_keys($printcito);

            ?>
            <h4 class="text-center">Detalles de Solicitud</h4>
            <hr>
            <div class="col d-flex flex-row">
                <div class="col-4 radios">
                    <h6 style="margin: 0 0 1.2rem 11%;">Por favor elija una accion</h6>
                    <div class="form-check">
                        <input type="radio" class="btn-check" name="editSoli" id="pendiente" value="0" checked>
                        <label for="pendiente" class="rat btn btn-outline-secondary">Pendiente</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="btn-check" name="editSoli" id="aceptar" value="1">
                        <label for="aceptar" class="rat btn btn-outline-success">Aceptar solicitud</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="btn-check" name="editSoli" id="rechazar" value="2" data-bs-toggle="collapse"
                            data-bs-target="#contentId" aria-expanded="false" aria-controls="contentId">
                        <label for="rechazar" class=" rat btn btn-outline-danger">Rechazar solicitud</label>
                        <div class="collapse" id="contentId">
                            <div class="mb-3">
                                <label for="movito" class="form-label" id="colored">motivo</label>
                                <input type="text" class="form-control" name="movito" id="movito" aria-describedby="helpId"
                                    placeholder="texto">
                                <small id="helpId" class="form-text text-muted">ingrese el motivo de rechazo</small>
                            </div>
                        </div>
                    </div>
                    <style>
                        #colored {
                            background: none;
                            margin: 10px 0 0 0;
                            display: block;
                            position: relative;
                            padding: 0 0 0 0;
                            height: auto;
                        }
                    </style>
                </div>
                <div class="col-7">
                    <?php echo "<h6 class='text-center'>tipo de solicitud: " . $tipo[$tipoSoli] . "</h6>"; ?>
                    <div class="mx-auto">
                        <table class="table table-info">
                            <tbody>
                                <?php
                                foreach ($nombres as $key) {
                                    echo '
                                <tr class="primary">
                                    <th  scope="row">' . $key . '</th>
                                    </tr>
                                <tr>
                                    <td scope="row">' . $printcito[$key] . '</td>
                                </tr>  ';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- //PERMISO DE IMPRESION -->
            <input type="text" class="d-none" value="<?php echo $verificacionDestado ?>" id="coco">
            <?php
            break;
        default:
            # code...
            break;
    }

}
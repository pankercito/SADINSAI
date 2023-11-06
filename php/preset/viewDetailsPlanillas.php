<?php

if (isset($_POST["idSoli"])) {

    include('../conx.php');
    include("../function/getESCname.php");
    include("../function/criptCodes.php");
    include("../class/solicitudes.php");

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
            $ver = Solicitud::ObtenerSolicitud($id);

            $vear = $ver->Detalles();

            $corgale = $ver->DetallePLanillas();

            $printcito = $corgale[0];

            $nombres = array_keys($printcito);

            ?>
            <h4 class="text-center">Detalles de Solicitud</h4>
            <hr>
            <div class="table-responsive-sm">
                <?php echo "<h6 class='text-center'>tipo de solicitud: " . $tipo[$tipoSoli] . "</h6>"; ?>
                <div class="col-8 mx-auto">
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
            <!-- //PERMISO DE IMPRESION -->
            <input type="text" class="d-none" value="<?php echo $corgale[1][0] ?>" id="coco">
            <?php
            break;
        case '2':
            $ver = Solicitud::ObtenerSolicitud($id);

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
                    if($ky == "estado_permiso"){
                        $verificacionDestado = $le;
                    }
                }
            }

            $nombres = array_keys($printcito);

            ?>
            <h4 class="text-center">Detalles de Solicitud</h4>
            <hr>
            <div class="table-responsive-sm">
                <?php echo "<h6 class='text-center'>tipo de solicitud: " . $tipo[$tipoSoli] . "</h6>"; ?>
                <div class="col-8 mx-auto">
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
            <!-- //PERMISO DE IMPRESION -->
            <input type="text" class="d-none" value="<?php echo $verificacionDestado ?>" id="coco">
            <?php
            break;
        case '3':
            $ver = Solicitud::ObtenerSolicitud($id);

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
                    if($ky == "estado_permiso"){
                        $verificacionDestado = $le;
                    }
                }
            }

            $nombres = array_keys($printcito);

            ?>
            <h4 class="text-center">Detalles de Solicitud</h4>
            <hr>
            <div class="table-responsive-sm">
                <?php echo "<h6 class='text-center'>tipo de solicitud: " . $tipo[$tipoSoli] . "</h6>"; ?>
                <div class="col-8 mx-auto">
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
            <!-- //PERMISO DE IMPRESION -->
            <input type="text" class="d-none" value="<?php echo $verificacionDestado ?>" id="coco">
            <?php
            break;
        case '4':
            $ver = Solicitud::ObtenerSolicitud($id);

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
                    if($ky == "estado_permiso"){
                        $verificacionDestado = $le;
                    }
                }
            }

            $nombres = array_keys($printcito);

            ?>
            <h4 class="text-center">Detalles de Solicitud</h4>
            <hr>
            <div class="table-responsive-sm">
                <?php echo "<h6 class='text-center'>tipo de solicitud: " . $tipo[$tipoSoli] . "</h6>"; ?>
                <div class="col-8 mx-auto">
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
            <!-- //PERMISO DE IMPRESION -->
            <input type="text" class="d-none" value="<?php echo $verificacionDestado ?>" id="coco">
            <?php
            break;
        case '5':
            $ver = Solicitud::ObtenerSolicitud($id);

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
                    if($ky == "estado_permiso"){
                        $verificacionDestado = $le;
                    }
                }
            }

            $nombres = array_keys($printcito);

            ?>
            <h4 class="text-center">Detalles de Solicitud</h4>
            <hr>
            <div class="table-responsive-sm">
                <?php echo "<h6 class='text-center'>tipo de solicitud: " . $tipo[$tipoSoli] . "</h6>"; ?>
                <div class="col-8 mx-auto">
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
            <!-- //PERMISO DE IMPRESION -->
            <input type="text" class="d-none" value="<?php echo $verificacionDestado ?>" id="coco">
            <?php
            break;
        default:
            # code...
            break;
    }

}
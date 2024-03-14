<?php

if (isset($_POST["idSoli"]) && isset($_POST['tipoSoli'])) {

    include '../php/configIncludes.php';

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

    if ($tipoSoli != null) {
        $ver = Solicitud::obtenerSolicitud($id);

        $corgale = $ver->detallePLanillas();

        $printcito = $corgale[0];


        $nombres = array_keys($printcito);

        ?>
        <h4 class="text-center">Accion sobre Solicitud</h4>
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
                    <input type="radio" class="btn-check" name="editSoli" id="rechazar" value="2">
                    <label for="rechazar" class="rat btn btn-outline-danger">Rechazar solicitud</label>
                    <div class="collapse" id="collapseRechazar">
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
                <?php echo "<h5 class='text-center'>tipo de solicitud: " . $tipo[$tipoSoli] . "</h5>"; ?>
                <hr>
                <div class="mx-auto">
                    <table class="table table">
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
    }
}
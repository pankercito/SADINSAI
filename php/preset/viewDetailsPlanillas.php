<?php

if (isset($_POST["idSoli"])) {

    include "../preset/presetConfigIncludes.php";

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

    $ver = Solicitud::obtenerSolicitud($id);

    $vear = $ver->detalles();

    $corgale = $ver->detallePLanillas();

    $printcito = $corgale[0];

    $nombres = array_keys($printcito);

    ?>
    <h4 class="text-center">Detalles de Solicitud</h4>
    <hr>
    <div class="table-responsive-sm">
        <?php echo "<h6 class='text-center'>tipo de solicitud: " . $tipo[$tipoSoli] . "</h6>"; ?>
        <div class="col-8 mx-auto">
            <table class="table table">
                <tbody>
                    <?php
                    foreach ($nombres as $key) {
                        echo '
                                <tr class="primary">
                                    <th  scope="row">' . ucwords($key ). '</th>
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
}
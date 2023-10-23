<?php require_once("../php/sesionval.php"); ?>

<?php require("../php/adp.php"); ?>

<?php require("../layout/head.php"); ?>

<?php require("../layout/navbar.php"); ?>

<link rel="stylesheet" href="../styles/pdashboard.css">
<script src="../js/prestablecer.js"></script>


<!--SALUDO DE BIENVENIDA-->
<?php include("../layout/sidebar.php"); ?>
<script>
    $(document).ready(function () {
        setTimeout(() => {
            soliste();
        }, 1000);
    });
</script>
<div class="estructur-conten">
    <div class="grid-containerr">
        <div class="cuerpo">
            <div class="principal row mx-1 mb-4 justify-content-center" id="centro">
                <div class="col">
                    <?php
                    include('../php/class/auditoria.php');
                    $new = new Auditoria();
                    ?>
                    <p>Usuarios activos</p>
                    <ul class="userUl col-md-7 mx-auto">
                        <?php
                        //imprime una lista con usuarios activos y no activos
                        $us = $new->usersActives();
                        foreach ($us as $us) {
                            $dot = ($us['active'] == 1) ? "<i class='bi bi-dot active'></i>" : "<i class='bi bi-dot'></i>";
                            echo "<li class='user'><a class='aUser' href='perfil.php?perfil=" . $us['ci'] . "'>" . $dot . $us['user'] . " </a></li>";
                        }
                        ?>
                    </ul>
                </div>
                <div class="col-md-7">
                    <div id="canvasconten">
                        <canvas id="dashboard"></canvas>
                    </div>
                </div>
                <div class="col">
                    <p>acciones</p>
                    <button class="pedit pnomina btn btn-primary"
                        onclick="location.replace('perfil.php?perfil=<?php echo $wci ?>');">mi perfil</button>
                    <br>
                    <button class='pedit btn btn-warning' id="genReport">generar reporte</button>
                </div>
            </div>
            <hr class="alert alert-light">
            <!-- stats -->
            <div class="mb-2 mt-4 row mx-1 justify-content-center">
                <div class="bg-color-stats mx-1 d-flex flex-wrap col-md-6 justify-content-around alert">
                    <div class="concan text-star">
                        <canvas id="solicitudes" class="mb-4"></canvas>
                    </div>
                    <div class="alert-content">
                        <h5>detalles de solicitudes </h5>
                        <hr>
                        <div class="text-star table-responsive-sm">
                            <table class=" table table-borderless">
                                <tbody>
                                    <?php
                                    $r = $new->solicitudDetailstStats(date('y-m-d'));

                                    $tipoSolic = [
                                        "0" => "ingreso de personal",
                                        "1" => "edicion de datos",
                                        "2" => "ingreso de archivo",
                                        "3" => "eliminacion de archivo"
                                    ];

                                    foreach ($r as $r) {
                                        echo
                                            '<tr>
                                                <td class="text-start">
                                                    <h6>' . $tipoSolic[$r['tipo']] . '</h6>
                                                </td>
                                                <td></td>
                                                <td>
                                                    <h6>' . $r['count'] . '</h6>
                                                </td>
                                            </tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="bg-color-stats col alert">
                    <h5>inicios diarios por usuarios</h5>
                    <hr>
                    <div class="alert-content text-center ">
                        <div class="bg-color-stats table-responsive-sm">
                            <table class="table table-borderless">
                                <tbody>
                                <tbody>
                                    <?php
                                    $r = $new->userInixStats(date('Y-m-d'));
                                    foreach ($r as $r) {
                                        echo
                                            '<tr>
                                            <td class="text-start">
                                                <h6 class="ms-4 mb-0">' . $r['user'] . '</h6>
                                            </td>
                                            <td></td>
                                            <td>
                                                <h6 class="ms-2">' . $r['count'] . '</h6>
                                            </td>
                                        </tr>';
                                    }
                                    ?>
                                </tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="bg-color-stats col mx-1 alert">
                    <h5>archivos agregados en la semana</h5>
                    <hr>
                    <div class="alert-content text-center ">
                        <div class="bg-color-stats table-responsive-sm">
                            <table class="table table-borderless">
                                <tbody>
                                <tbody>
                                    <?php

                                    $dat = rangoFechas();

                                    function total($array)
                                    {

                                        foreach ($array as $key => $value) {
                                            @$total .= $value['count'] . '-';
                                        }

                                        $cadena = $total;
                                        // Convertimos la cadena en un array de números
                                        $numeros = explode("-", $cadena);
                                        // Declaramos una variable para almacenar la suma
                                        $suma = 0;
                                        // Iteramos sobre el array de números
                                        foreach ($numeros as $numero) {
                                            // Convertimos cada número a un número entero
                                            $numeroEntero = intval($numero);
                                            // Sumamos el número al acumulado
                                            $suma += $numeroEntero;
                                        }
                                        return $suma;
                                    }

                                    $d = $new->archivesDetailsStats($dat['lunes'], $dat['domingo']);

                                    echo '<h6>total de archivos: ' . @total($d) . '</h6>';

                                    $r = $conn->query("SELECT * FROM tiposarch");

                                    while ($tori = $r->fetch_object()) {
                                        $t[$tori->id_tipo] = $tori->nombre_tipo_arch;
                                    }

                                    foreach ($d as $row) {
                                        // Agrega las celdas a la tabla
                                        echo "<tr class='text-start ps-4 ms-2'>";
                                        echo "<td class='px-4 ms-5'>" . $t[$row['tipo']] . "</td>";
                                        echo "<td>" . $row['count'] . "</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="../resources/import/Chart/chart.js"></script>
        <script src="../resources/import/Chart/chart.umd.js"></script>
        <script src="../js/dashboard.js"></script>
    </div>
</div>

<?php require("../layout/footer.php"); ?>
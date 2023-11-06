<?php require_once "../php/sesionval.php"; ?>

<?php require("../php/adp.php"); ?>

<?php require("../layout/head.php"); ?>

<?php require("../layout/navbar.php"); ?>

<link rel="stylesheet" href="../styles/pdashboard.css">
<script src="../js/prestablecer.js"></script>

<!--SALUDO DE BIENVENIDA-->
<?php include "../layout/sidebar.php" ?>
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
                    <p style="margin-bottom: 0;">Acciones</p>
                    <button class="pedit pnomina btn btn-primary"
                        onclick="location.replace('perfil.php?perfil=<?php echo $wci ?>');">mi perfil</button>
                    <br>
                    <button class='pedit btn btn-warning mb-3' id="genReport">generar reporte</button>
                    <p style="margin-bottom: 5px;">Usuarios activos</p>
                    <div class="col" style="overflow-y: auto;     max-height: 12.3rem;">
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

                </div>
                <div class="col-md-7">
                    <div id="canvasconten">
                        <canvas id="dashboard"></canvas>
                    </div>
                </div>
                <div class="col">
                    <div class="bg-color-stats d-flex flex-column justify-content-around alert">
                        <h5 style="margin-bottom: 0;">informacion extra</h5>
                        <hr>
                        <p id="prom" style="font-size: 14px !important; color: #212529;">promedio semanal de
                            gestiones realizadas: %s</p>
                        <p id="prem" style="font-size: 14px !important; color: #212529;">promedio semanal de archivos
                            agregados: %s
                        </p>
                        <p id="prim" style="font-size: 14px !important; color: #212529;">promedio semanal de inicios de
                            sesion: %s
                        </p>
                    </div>
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
                        <h5>detalles de gestiones del dia</h5>
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
                <script type="module" src="../resources/import/Chart/chart.js"></script>
                <script src="../resources/import/Chart/chart.umd.js"></script>
                <div class="bg-color-stats col alert">
                    <h5>ingresos de usuarios del dia</h5>
                    <hr>
                    <div class="alert-content text-center ">
                        <div class="bg-color-stats table-responsive-sm">
                            <table class="table table-borderless">
                                <tbody>
                                <tbody>
                                    <?php
                                    $r = $new->userInixStats(date('Y-m-d'));

                                    if (count($r) != 0) {
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
                                    } else {
                                        echo "<h6>ningun usuario a iniciado sesion hoy</h6> ";
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
                                    $dat = rangoFechas(); //rango de fechas semanal automatico
                                    
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
            <div class="mb-2 mt-4 row mx-1 justify-content-center">
                <div class="bg-color-stats mx-1 d-flex flex-wrap col justify-content-around alert">
                    <div class="concan text-star">
                        <canvas id="solicitudesProm" style="width: 30rem!importan;"></canvas>
                    </div>
                    <div class="alert-content">
                        <h5>promedio de aceptacion de solicitudes</h5>
                        <hr>
                        <div class="text-star table-responsive-sm">
                            <p class="panel-color" id="total">total de solicitudes: %s</p>
                            <table class=" table table-borderless">
                                <tbody>
                                    <tr>
                                        <td class="text-start">
                                            <h6>aceptadas</h6>
                                            <h6>rechazadas</h6>
                                            <h6>anuladas</h6>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <h6 id="aceptadas">%s</h6>
                                            <h6 id="rechazadas">%s</h6>
                                            <h6 id="anuladas">%s</h6>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <hr>
                            <p class="subtitulo">no se toman en cuenta solicitudes pendientes</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="../js/dashboard.js"></script>
        <style>
            canvas#solicitudesProm {
                width: 700px !important;
                max-height: 200px !important;
            }

            .panel-color {
                font-size: 15px;
                color: #212529 !important;
                font-weight: normal;
            }

            .subtitulo {
                color: #a3a3a3;
                font-size: 13px;
                font-weight: normal;
            }

            .ecport {
                background: #28a745 !important;
                color: #fff !important;
                border-radius: 7px !important;
                border: none !important;
            }

            .ecport:hover {
                background: #348747 !important;
            }

            tr {
                vertical-align: -webkit-baseline-middle;
            }
        </style>
    </div>
</div>

<?php require("../layout/footer.php"); ?>
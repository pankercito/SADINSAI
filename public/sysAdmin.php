<?php require_once("../php/sesionval.php"); ?>

<?php require("../php/adp.php"); ?>

<?php require("../layout/head.php"); ?>

<?php require("../layout/navbar.php"); ?>

<link rel="stylesheet" href="../styles/pdashboard.css">
<script src="../js/prestablecer.js"></script>


<!--SALUDO DE BIENVENIDA-->
<section name="cromaconten">
    <div class="contencroma">
        <?php include("../layout/sidebar.php"); ?>
    </div>
</section>

<div class="estructur-conten">
    <div class="grid-containerr">
        <div class="cuerpo">
            <div class="principal row mx-1 mb-4 justify-content-center" id="centro">
                <div class="col">
                    <?php
                    include('../php/class/auditoria.php');
                    $new = new auditoria();
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
                    <p>Informacion extra</p>
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
                                                <h6 class="ms-2">' . $r['cont'] . '</h6>
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
                    <h5>archivos agregados</h5>
                    <hr>
                    <div class="alert-content text-center ">
                        <div class="bg-color-stats table-responsive-sm">
                            <table class="table table-borderless">
                                <tbody>
                                <tbody>
                                    <?php
                                    $r = $new->archivesStats();
                                    $d = $new->archivesDetailsStats();

                                    echo '<h6>total de archivos en el sistema: ' . $r[0]['total'] . '</h6>';
                                    
                                    foreach ($d as $d) {
                                        echo
                                            '<tr>
                                            <td class="text-start">
                                                <h6 class="ms-4 mb-0">' . $d['tipo'] . '</h6>
                                            </td>
                                            <td></td>
                                            <td>
                                                <h6 class="ms-2">' . $d['count'] . '</h6>
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
            </div>
            <!-- <div class="mb-2 mt-4 row mx-1 justify-content-center">
                <div class="bg-color-stats col mx-1 alert">
                    <h5>movimientos de usuarios</h5>
                    <hr>

                </div>
            </div> -->
        </div>
        <script src="../resources/import/Chart/chart.js"></script>
        <script src="../js/dashboard.js"></script>
    </div>
</div>

<?php require("../layout/footer.php"); ?>
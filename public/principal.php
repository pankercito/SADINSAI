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
        <div class="row">
            <div class="centro col-lg-9 d-flex" id="centro">
                <div class="userDash mx-auto col-md-2">
                    <?php
                    include('../php/class/auditoria.php');
                    $new = new auditoria();
                    ?>
                    <p>Usuarios activos</p>
                    <ul class="userUl">
                        <li class="user">
                        <?php
                        //imprime una lista con usuarios activos y no activos
                        echo $new->usersActives();
                        ?></li>
                    </ul>
                </div>
                <div class="conteDash mx-auto col-md-8">
                    <canvas id="dashboard"></canvas>
                </div>
            </div>
            <div class="colunma col-lg-3" id="columna">
                <p>Informacion extra</p>
                <a class="pnomina btn btn-primary" href="perfil.php?perfil=<?php echo $wci ?>">Mi perfil</a>
                <br>
                <button class='pedit btn btn-warning' id="editar">generar reporte</button>
            </div>
            <script src="../resources/import/Chart/chart.js"></script>
            <script src="../js/dashboard.js"></script>
        </div>
    </div>
</div>

<?php require("../layout/footer.php"); ?>
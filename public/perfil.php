<?php require_once("../php/sesionval.php"); ?>

<?php require("../layout/head.php"); ?>

<?php require("../layout/navbar.php"); ?>
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
            <div class="centro col-lg-9" id="centro">
                <?php require_once("../php/preset/seleccionPerfil.php"); ?>
            </div>
            <?php require_once("../layout/editarUsuario.php"); ?>
            <div class="colunma col-lg-3 mt-2" id="columna">
                <p style="color: white; font-weight:500;">Informacion extra</p>
                <a class="pnomina btn btn-primary" href=''>generar reporte</a>
                <br>
                <button class='pedit btn btn-warning' id="editar">editar datos</button>
            </div>
        </div>
    </div>
</div>
<script src="../js/formRegistroValidacion.js"></script>
<script src="../js/editUserComplement.js"></script>
<script src="../js/selectorScript.js"></script>
<?php require("../layout/footer.php"); ?>
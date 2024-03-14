<?php require "../php/sesionval.php" ?>

<?php require "../layout/head.php" ?>

<?php require "../layout/navbar.php" ?>

<script src="../js/requerimientos.js"></script>
<script src="../js/prestablecer.js"></script>

<!--SALUDO DE BIENVENIDA-->
<?php include "../layout/sidebar.php" ?>

<div class="estructur-conten">
    <div class="grid-containerr">
        <div class="row">
            <div class="centro col-lg-9" id="centro">
                <?php require "../php/preset/seleccionPerfil.php" ?>
            </div>
            <?php include "../layout/editarUsuario.php" ?>
            <div class="colunma col-md-3 mt-2" id="columna">
                <p style="color: white; font-weight:500;">acciones</p>
                <button class="pedit btn btn-primary" id="generar"
                onclick="reportePerfil('<?php echo encriptar($SetCi) ?>')">archivos
                faltantes</button>
                <br>
                <button class='pedit btn btn-secondary' id="requeri"
                onclick="requerido('<?php echo encriptar($SetCi) ?>')">requerimientos</button>
                <br>
                <button class='pedit btn btn-warning' id="editar">editar datos</button>
            </div>
        </div>
    </div>
</div>
<script>
    function reportePerfil(cedula) {
        $.ajax({
            url: "../php/archidataVerify.php",
            type: "post",
            data: {
                personal: cedula
            },
            success: function (siu) {
                $.confirm({
                    title: "Archivos requeridos faltantes",
                    content: siu,
                    buttons: {
                        cer: {
                            text: "cerrar",
                            action: function () {

                            }
                        }
                    }
                })
            }
        });
    }
</script>
<style>
    form h4 {
        color: #f8f9fa;
    }

    .sel3 label {
        color: #f8f9fa;
    }
</style>
<script src="../js/formRegistroValidacion.js"></script>
<script src="../js/editUserComplement.js"></script>
<script src="../js/selectorScript.js"></script>
<?php require "../layout/footer.php" ?>
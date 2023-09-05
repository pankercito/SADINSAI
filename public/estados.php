<?php require_once("../php/sesionval.php"); ?>

<?php require("../layout/head.php"); ?>

<?php
include("../php/function/removerAcentos.php");

require("../layout/navbar.php");
?>


<link rel="stylesheet" href="../styles/estados.css">
<link rel="stylesheet" href="../styles/viewtables.css">

<!--SALUDO DE BIENVENIDA-->
<section name="cromaconten">
    <div class="contencroma">
        <?php
        include("../layout/sidebar.php");
        ?>
    </div>
</section>

<div class="estructur-conten">
    <div class="grid-containerr">

        <div class="col-lg-12">
            <div class="sot">
                <table id="example" class="table table-striped">
                    <thead>
                        <tr>
                            <th>estado</th>
                            <th>sede</th>
                            <th>nombre</th>
                            <th>apellido</th>
                            <th>ci</th>
                            <th>telefono</th>
                            <th>cargo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php include "../php/preset/seleccionStados.php" ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>estado</th>
                            <th>sede</th>
                            <th>nombre</th>
                            <th>apellido</th>
                            <th>ci</th>
                            <th>telefono</th>
                            <th>cargo</th>
                        </tr>
                    </tfoot>
                </table>
                <script src="../js/estadosRecarga.js"></script>
            </div>
        </div>
    </div>
</div>
<?php require("../layout/footer.php"); ?>
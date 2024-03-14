<?php require_once "../php/sesionval.php"; ?>

<?php require "../layout/head.php"; ?>

<?php require "../layout/navbar.php"; ?>

<link rel="stylesheet" href="../styles/estados.css">
<link rel="stylesheet" href="../styles/viewtables.css">

<!--SALUDO DE BIENVENIDA-->
<?php include "../layout/sidebar.php" ?>

<div class="estructur-conten">
    <div class="grid-containerr">
        <div class="col-md-12">
            <h4 class="mx-auto mb-2" style="color: #e7e7e7;">PERSONAL DE LA EMPRESA</h4>
            <hr style="border-color:white;">
            <div class="sot mx-auto">
                <table id="table" class="table table-striped ">
                    <thead>
                        <tr>
                            <th>estado</th>
                            <th>sede</th>
                            <th>nombre</th>
                            <th>apellido</th>
                            <th>cedula</th>
                            <th>departamento</th>
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
                            <th>cedula</th>
                            <th>departamento</th>
                            <th>cargo</th>
                        </tr>
                    </tfoot>
                </table>
                <script src="../js/estadosRecarga.js"></script>
            </div>
        </div>
    </div>
</div>

<?php require "../layout/footer.php"; ?>
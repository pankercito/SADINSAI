<?php require_once "../php/sesionval.php"?>

<?php require "../layout/head.php"?>

<?php require "../layout/navbar.php"?>

<link rel="stylesheet" href="../styles/viewtables.css">
<link rel="stylesheet" href="../styles/nomina.css">
<link rel="stylesheet" href="../styles/solicitudes.css">

<!--SALUDO DE BIENVENIDA-->
<?php include "../layout/sidebar.php" ?>

<!-- notificacion script -->
<?php include "../php/preset/notificacion.php" ?>

<div class="estructur-solicitudes">
    <div class="grid-containerr">
        <div class="row">
            <div class="n-estructure col">
                <h4 class="mx-auto mb-2" style="color: #e7e7e7;">SOLICITUDES Y PERMISOS</h4>
                <hr style="border-color:white;">
                <div class="container mt-4">
                    <?php incluir("../layout/solicitudesPlanillasAdmin.php", "../layout/solicitudesPlanillasUser.php") ?>
                </div>
            </div>
            <style>
                div#table_filter label {
                    display: flex;
                    align-content: center;
                    align-items: center;
                }

                label {
                    background: #c5d7f2;
                }

                .btn-success {
                    background: #8cdfb8;
                    border-color: #47b381;
                }

                .btn-success:hover {
                    background: #33b779;
                }

                a.aprState.alert.alert-secondary:not(:disabled):hover {
                    background: #bdbdbd;
                }

                <?php

                if ($adpval == 0) {
                    echo "a.aprState.alert.alert-secondary:hover {
                        background: #e2e3e5  !important;
                    }
                    a.aprState.alert.alert-secondary {
                        cursor: default !important;
                        margin: 0;
                    }";
                }


                ?>
            </style>
        </div>
    </div>
</div>
<script src="../js/solicitudes.js"></script>

<?php require "../layout/footer.php" ?>
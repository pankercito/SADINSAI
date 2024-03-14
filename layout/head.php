<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

    <!--TITULO DE LA PAGINA-->
    <title>
        <?php require_once '../php/preset/titleHead.php' ?>
    </title>

    <!--js jQuery -->
    <script src="../resources/import/jquery/jquery-3.6.0.js"></script>
    <script src="../resources/import/jquery/jquery-3.6.0.min.js"></script>
    <!--js jQuery DataTables-->
    <link href="../resources/import/DataTables/dataTables.min.css" rel="stylesheet">
    <script src="../resources/import/DataTables/dataTables.min.js"></script>

    <!--js jQuery DataTables SEMANTIC UI -->
    <link href="../resources/import/DataTables/themes/Semantic-UI/dataTables.semanticui.min.css" rel="stylesheet">
    <script src="../resources/import/DataTables/themes/Semantic-UI/dataTables.semanticui.min.js"></script>
    <link href="../resources/import/DataTables/themes/Semantic-UI/semantic.min.css" rel="stylesheet">
    <script src="../resources/import/DataTables/themes/Semantic-UI/semantic.min.js"></script>

    <!--js jQuery Confirm -->
    <script src="../resources/import/jQuery-Confirm/jquery-confirm.min.js"></script>
    <link href="../resources/import/jQuery-Confirm/jquery-confirm.min.css" rel="stylesheet">

    <!-- PDF JS  -->
    <script src="../resources/import/Pdf/build/pdf.js"></script>
    <link rel="stylesheet" href="../resources/import/Pdf/web/viewer.css">

    <!-- moment JS -->
    <script src="../resources/import/Moment/moment.min.js"></script>

    <!-- Notie  -->
    <script src="../resources/import/notie/notie.js"></script>
    <link rel="stylesheet" href="../resources/import/notie/notie.css">

    <!-- Select2 -->
    <script src="../resources/import/Select2/select2.min.js"></script>
    <link rel="stylesheet" href="../resources/import/select2/Select2.min.css">

    <!-- funciones js  -->
    <script src="../js/nuevoGrafico.js"></script>
    <script src="../js/verification/input_verify.js"></script>
    <script src="../js/jeisonXD.js"></script>
    <script src="../js/reporteSolis.js"></script>
    <script src="../js/search.js"></script>
    <script src="../js/detalleSYS.js"></script>

    <!-- estilos -->
    <link href="../resources/import/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../resources/import/Bootstrap/font/bootstrap-icons.css">
    <script src="../resources/import/bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../styles/buttomlogin.css">
    <link rel="shorcut icon" href="../resources/faviconverde.png">
    <link rel="stylesheet" href="../styles/background.css">
    <link rel="stylesheet" href="../styles/perfil.css">
    <link rel="stylesheet" href="../styles/body.css">
    <link rel="stylesheet" href="../styles/menutop.css">
    <link rel="stylesheet" href="../styles/croma.css">

    <style>
        /* Styles can be overwritten after inlcuding notie.css */
        .notie-container {
            margin-top: 64px;
            max-height: 60px;
            box-shadow: none;
            z-index: 20;
        }

        article p {
            font-size: 12px !important;
            color: #f5f5f5 !important;
        }

        article {
            font-size: 20px;
            color: #f5f5f5 !important;
        }

        article#gestionSoliData {
            font-size: 20px;
            color: #f5f5f5 !important;
        }

        .notie-textbox {
            padding: 5px;
        }

        .notie-background-overlay {
            background: #F0F0F0;
        }

        .jconfirm.jconfirm-supervan .jconfirm-bg {
            background: rgba(95, 93, 103, 0.963);
        }
    </style>
    <script type="text/javascript">
        //  se quita al cargar por completo la pagina
        var panel =
            $.dialog({
                title: "",
                closeIcon: false, // hides the close icon.
                content: '<div class="spinner-border text-light" role="status"><span class="visually-hidden"></span></div><br>Cargando...',
                theme: 'supervan'
            });

        window.onload = function () {
            $(document).ready(function () {
                setTimeout(() => {
                    panel.close();
                }, 500);
            })

            const url = window.location.href;
            const queryString = window.location.search;
            const urlWithoutGet = url.split("?")[0];
        };

        function resetZoom() {
            // Obtén el valor actual del zoom
            const zoom = window.getComputedStyle(document.body).getPropertyValue("zoom");

            // Si el zoom actual es diferente de 100%, establece el zoom en 100%
            if (zoom !== "1") {
                window.zoom = 1;
            }
        }

        function soliste() {
            $.ajax({
                url: "../php/verificarSolisEstado.php",
                success: function (c) {
                    if (jeisonXD(c)) {
                        let coci = JSON.parse(c);
                        if (coci['carmen']['veri']) {
                            if (coci['carmen']['totalSolis'] > 0) {
                                notie.alert({
                                    type: 2,
                                    text: "<article>solicitudes pendientes: " + coci['carmen']['totalSolis'] + "<p style=''>las solicitudes se anularan automaticamente en 2 dias sino son atendidas</p></article>",
                                    time: 3
                                });

                                setTimeout(() => {
                                    if (coci['carmen']['totalGestion'] > 0) {
                                        notie.alert({
                                            type: 4,
                                            text: "<article id='gestionSoliData'>Gestion de datos pendientes: " + coci['carmen']['totalGestion'] + "<p style=''>las solicitudes se anularan automaticamente en 3 dias sino son atendidas</p></article>",
                                            time: 3
                                        });
                                    }
                                }, 2800);
                            } else {
                                if (coci['carmen']['totalGestion'] > 0) {
                                    notie.alert({
                                        type: 4,
                                        text: "<article id='gestionSoliData'>Gestion de datos pendientes: " + coci['carmen']['totalGestion'] + "<p style=''>las solicitudes se anularan automaticamente en 3 dias sino son atendidas</p></article>",
                                        time: 3
                                    });
                                }
                            }

                        }
                    } else {

                    }
                }
            });
        }

        function notifySolis(tipo, mensaje, active) {
            if (active == 1) {
                // Mostrar el mensaje en el contenedor
                notie.alert({
                    type: tipo,
                    text: "<article id='gestionSoliData'>" + mensaje + "</article>",
                    time: 3
                });
            }
        }

        // Agrega un oyente de eventos para el evento "load"
        document.addEventListener("load", resetZoom);

    </script>

</head>

<body class="logged-in env-production page-responsive">
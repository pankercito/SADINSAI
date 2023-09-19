<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--TITULO DE LA PAGINA-->
    <title>
        <?php require_once('../php/preset/titleHead.php') ?>
    </title>

    <script src="../resources/import/jquery/jquery-3.6.0.js"></script> 
    <!--js jQuery -->
    <script src="../resources/import/jquery/jquery-3.6.0.min.js"></script> 
    <!--js jQuery -->
    <link href="../resources/import/jQuery-DataTables/jquery.dataTables.min.css" rel="stylesheet">
    <!--js jQuery DataTables -->
    <script src="../resources/import/jQuery-DataTables/jquery.dataTables.min.js"></script> 
    <!--js jQuery DataTables-->
    <link href="../resources/import/jQuery-DataTables/themes/Semantic-UI/dataTables.semanticui.min.css"
        rel="stylesheet"> <!--js jQuery DataTables SEMANTIC UI -->
    <script src="../resources/import/jQuery-DataTables/themes/Semantic-UI/dataTables.semanticui.min.js"></script>
    <!--js jQuery DataTables SEMANTIC UI -->
    <link href="../resources/import/jQuery-DataTables/themes/Semantic-UI/semantic.min.css" rel="stylesheet">
    <!--js jQuery DataTables SEMANTIC UI -->
    <script src="../resources/import/jQuery-DataTables/themes/Semantic-UI/semantic.min.js"></script>
    <!--js jQuery DataTables SEMANTIC UI -->
    <script src="../resources/import/jQuery-Confirm/jquery-confirm.min.js"></script> <!--js jQuery Confirm -->
    <link href="../resources/import/jQuery-Confirm/jquery-confirm.min.css" rel="stylesheet"> <!--js jQuery Confirm -->
    <link href="../resources/import/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../resources/import/Bootstrap/font/bootstrap-icons.css">
    <script src="../resources/import/Pdf/build/pdf.js"></script>
    <link rel="stylesheet" href="../resources/import/Pdf/web/viewer.css">
    <link rel="stylesheet" href="../styles/buttomlogin.css">
    <!-- funciones js  -->
    <script src="../js/nuevoGrafico.js"></script>
    <script src="../js/jeisonXD.js"></script>
    <!-- ******** -->
    <link rel="shorcut icon" href="../resources/faviconverde.png">
    <link rel="stylesheet" href="../styles/background.css">
    <link rel="stylesheet" href="../styles/perfil.css">
    <link rel="stylesheet" href="../styles/body.css">
    <link rel="stylesheet" href="../styles/menutop.css">
    <link rel="stylesheet" href="../styles/croma.css">
</head>

<body class="logged-in env-production page-responsive">
    <script type="text/javascript">
        // reescalar
        function scaleWindowTo100() {
            window.resizeTo(window.innerWidth, window.innerHeight);
        }

        //  se quita al cargar por completo la pagina
        var panel =
            $.dialog({
                title: "",
                closeIcon: false, // hides the close icon.
                content: '<div class="spinner-border text-light" role="status"><span class="visually-hidden"></span></div><br>Cargando...',
                theme: 'supervan'
            });
        window.onload = function () {
            setTimeout(() => {
                panel.close();
            }, 1000);
        };
    </script>
    <style>
        .jconfirm.jconfirm-supervan .jconfirm-bg {
            background: rgba(95, 93, 103, 0.963);
        }
    </style>
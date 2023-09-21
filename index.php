<!DOCTYPE html>
<html lang="es">

<head>
    <!--TITULO DE LA PAGINA-->
    <title>SADINSAI | Inicio de Sesi&oacute;n</title>

    <!--HOJAS DE ESTILO/BOOTSTRAP-->
    <script src="resources/import/jquery/jquery-3.6.0.js"></script> <!--js jQuery -->
    <script src="resources/import/jquery/jquery-3.6.0.min.js"></script> <!--js jQuery -->
    <link href="resources/import/jQuery-DataTables/jquery.dataTables.min.css" rel="stylesheet">
    <!--js jQuery DataTables -->
    <script src="resources/import/jQuery-DataTables/jquery.dataTables.min.js"></script> <!--js jQuery DataTables-->
    <link href="resources/import/jQuery-DataTables/themes/Semantic-UI/dataTables.semanticui.min.css" rel="stylesheet">
    <!--js jQuery DataTables SEMANTIC UI -->
    <script src="resources/import/jQuery-DataTables/themes/Semantic-UI/dataTables.semanticui.min.js"></script>
    <!--js jQuery DataTables SEMANTIC UI -->
    <link href="resources/import/jQuery-DataTables/themes/Semantic-UI/semantic.min.css" rel="stylesheet">
    <!--js jQuery DataTables SEMANTIC UI -->
    <script src="resources/import/jQuery-DataTables/themes/Semantic-UI/semantic.min.js"></script>
    <!--js jQuery DataTables SEMANTIC UI -->
    <script src="resources/import/jQuery-Confirm/jquery-confirm.min.js"></script> <!--js jQuery Confirm -->
    <link href="resources/import/jQuery-Confirm/jquery-confirm.min.css" rel="stylesheet"> <!--js jQuery Confirm -->
    <link href="resources/import/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="resources/import/Bootstrap/font/bootstrap-icons.css">
    <link rel="stylesheet" href="styles/buttomlogin.css">
    <link rel="shorcut icon" href="resources/faviconverde.png">
    <link rel="stylesheet" href="styles/background.css">
    <link rel="stylesheet" href="styles/login.css">
</head>

<body class="logged-in env-production page-responsive" style="word-wrap: break-word;">
    <div class="col-lg-12">
        <div class="sadin">
            <img src="resources/sadinverde.png">
        </div>
    </div>

    <section class="col-lg-12 "><!--seccion de login-->
        <form action="../sadinsai/php/validation.php" method="post"> <!---ACCION DEL FORMULADIO-->
            <div id="login-box">
                <p>INICIO DE SESI&Oacute;N</p>
                <div class="form">
                    <div class="item">
                        <!--SE UTILIZA PARA CASILLAS DE NOMBRE DE USUARIO-->
                        <i class="bi bi-person-fill"></i>
                        <input type="text" placeholder="Usuario" name="userlg" required>
                    </div>
                    <div class="item">
                        <i class="bi bi-input-cursor"></i>
                        <input type="password" placeholder="Contrase&ntilde;a" name="passlg" required>
                    </div>
                    <?php
                    require("php/preset/fallo.php");
                    ?>
                    <button type="submit" name="login" class="btn btn-link btn-default">iniciar</button>
                </div>
                <!-- PAGINA DE RECUPERACION -->
                <div class="parte-abajo">
                    <a href="private/recovery.php" class="button">Olvide mi Contrase&ntilde;a</a>
                </div>
            </div>
        </form>
    </section>
    <section class="footer col-lg-12">
        <div class="row justify-conten-center">
            <div class="mx-auto">
                <img src="resources/ins.png" alt="insailogo">
            </div>
        </div>
    </section>
</body>
</html>
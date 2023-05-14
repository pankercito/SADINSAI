<!DOCTYPE html>
<html lang="es">
<head>
    <!--TITULO DE LA PAGINA-->
    <title><?php require_once('php/titlehead.php')?></title>
    
    <!--HOJAS DE ESTILO/BOOTSTRAP-->
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script src="Bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <link rel="stylesheet" href="styles/buttomlogin.css">
    <link rel="shorcut icon" href="recursos/faviconverde.png">
    <link rel="stylesheet" href="styles/background.css">
    <link rel="stylesheet" href="styles/catg-1.css">
    <link rel="stylesheet" href="styles/perfil.css">
    <link rel="stylesheet" href="styles/regiform.css">
    <link rel="stylesheet" href="styles/body.css">
    <link rel="stylesheet" href="styles/menutop.css">
    <link rel="stylesheet" href="styles/croma.1.css">
    <link rel="stylesheet" href="styles/viewtables.css">
</head>    

<body  class="logged-in env-production page-responsive" style="word-wrap: break-word;">

<link rel="stylesheet" href="styles/login.css">

<div class="col-lg-12">
    <div class="sadin"> 
        <img src="recursos/sadinverde.png">
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
                    require ("php/fallo.php");
                ?>
                <button type="submit" name="login" class="btn btn-link btn-default">Iniciar</button>
            </div>
            <!--PAGINA DE RECUPERACION
            <div class="parte-abajo">
                <a href="AQUI VA LA PAGINAS DE RECUPERACION" class="button">Olvide mi Contrase&ntilde;a</a> 
            </div>-->
        </div>
    </form>
</section>
<section class="footer col-lg-12"> 
 <div id="cena">
    <div class="ins">
        <img src="recursos/ins.png" alt="insailogo">
        <hr> </hr>
    </div>
    <div class="bicent">     
         <img src="recursos/sintillo.jpg" alt="bicentenario">
    </div>
 </div>
</section>
</body>
</html>
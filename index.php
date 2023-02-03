<?php 
include ("layout/head.php")
?>

<style>
    #cena { /*ACOMODADOR CINTILLO*/
    position: fixed;
    border-color: none;
    background: none;
    height: 60px;
    left: 0;
    bottom: 0;
    margin-top: 10%;
    width: 100%;}
</style>


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
                    if(isset($_GET["fallo"])){
                            echo "<div class='alert alert-danger' style='color:red'>
                            Usuario y/o contraseña invalido</div>
                            <style>
                                .alert {
                                position: relative;
                                padding: 0.75rem 1.25rem;
                                margin-top: 0.5rem;
                                border: 1px solid transparent;
                                border-radius: 5px;
                                margin-bottom: -15px;
                            }
                            </style>";
                    }
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
  
<?php 
include ("layout/footer.php")
?>


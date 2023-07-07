<?php require_once("../php/sesionval.php"); ?> 

<?php require("../layout/head.php"); ?>

<?php require("../layout/navbar.php"); ?>

<?php require("../php/funtion/adminSet.php"); ?>

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
        <?php   require_once("../php/preset/seleccionPerfil.php"); ?>
      </div>
      <?php   require_once("../layout/editarUsuario.php"); ?>
      <div class="colunma col-lg-3" id="columna">
        <p>Informacion extra</p>
        <a class="pnomina btn btn-primary" href=''>Nomina de Usuario</a>
        <br>
        <button class='pedit btn btn-warning' id="editar">Editar datos</button>
        <br>
        <p>Archivos totales = %datos</p>
        <p>Archivos faltantes = %datos</p>
      </div>
    </div>
  </div>
</div>
<script src="../js/formRegistroValidacion.js"></script>
<script src="../js/editUserComplement.js"></script>
<script src="../js/selectorScript.js"></script>
<?php require ("../layout/footer.php"); ?>
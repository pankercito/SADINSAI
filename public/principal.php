<?php require_once("../php/sesionval.php"); ?> 

<?php require("../layout/head.php"); ?>

<?php require("../layout/navbar.php"); ?>

<!--SALUDO DE BIENVENIDA-->
<section name="cromaconten"> 
  <div class="contencroma">
    <?php include("../layout/sidebar.php"); ?>
  </div>
</section>

<div class="estructur-conten">
  <div class="grid-containerr">
    <div class="row">
      <div class="col-lg-9">
        <?php   require_once("../php/preset/seleccionPerfil.php"); ?>
      </div>
      <div class="col-lg-3">
        <p>Informacion extra</p>
        <a class="pnomina btn btn-primary" href=''>Nomina de Usuario</a>
        <br>
        <?php
          $opcion1 = "<a class='pedit btn btn-warning' href=''>Editar datos</a>";
          $opcion2 = "";
          include("../php/opcional.php");
        ?>
        <p>Archivos totales = %datos</p>
        <p>Archivos faltantes = %datos</p>
      </div>
      </div>
    </div>
  </div>
</div>

<?php require ("../layout/footer.php"); ?>
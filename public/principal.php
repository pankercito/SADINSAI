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
        <?php   require_once ("../php/seleccion.php"); ?>
      </div>
      <div class="col-lg-3">
        <p>Informacion extra</p>
        <a href='#'>Nomina de Usuario</a>
        <?php
          $opcion1 = "<a href='#'>Editar datos</a>";
          $opcion2 = "";
          include("../php/opcional.php");
        ?>
        <p>Archivos totales = #</p>
        <p>Archivos faltantes = #</p>
      </div>
      </div>
    </div>
  </div>
</div>

<?php require ("../layout/footer.php"); ?>
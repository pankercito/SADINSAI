<?php require_once ("../php/sesionval.php"); ?> 

<?php require ("../layout/head.php"); ?>

<?php require("../layout/navbar.php"); ?>

<link rel="stylesheet" href="../styles/estados.css">

<!--SALUDO DE BIENVENIDA-->
<section name="cromaconten"> 
  <div class="contencroma">
    <?php
      include ("../layout/sidebar.php");
    ?>
  </div>
</section>

<div class="estructur-conten">
  <div class="grid-containerr">
    <div class="row">
      <div class="col-lg-6">
        <?php 
          require_once ("../layout/estadosTable.php");
        ?>
      </div>
      <div class="col-lg-5">
        <p>Sedes</p>
        <?php include "../php/seleccionStados.php"?>
      </div>
      </div>
    </div>
  </div>
</div>

<?php require ("../layout/footer.php"); ?>
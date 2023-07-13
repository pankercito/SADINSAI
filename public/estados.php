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
        <?php 
          require_once ("../layout/estadosTable.php");
        ?>
      <div class="col-lg-2">
        <h6 class="n-inf">busqueda rapida</h6>
			  <div class="tb_search">
				  <input type="text" id="estadosSearch" onkeyup="FiltroEstado()" placeholder="Buscar..." class="form-control">
        </div>
      </div>
      <div class="sot col-lg-8">
        <div class="conten">
          <?php include "../php/preset/seleccionStados.php"?>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="../js/search.js"></script>

<?php require ("../layout/footer.php"); ?>
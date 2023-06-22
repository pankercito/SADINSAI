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
      <div class="sot col-lg-5">
        <div class="conten">
					<p class="n-inf">busqueda rapida</p>
					<div class="tb_search">
						<input type="text" id="estadosSearch" onkeyup="FiltroEstado()" placeholder="Buscar..." class="form-control">
          </div>
        </div>        
        <p>sedes</p>
        <?php include "../php/preset/seleccionStados.php"?>
      </div>
      </div>
    </div>
  </div>
</div>
<script src="../js/search.js"></script>

<?php require ("../layout/footer.php"); ?>
<?php require_once ("../php/sesionval.php"); ?> 

<?php require ("../layout/head.php"); ?>

<link rel="stylesheet" href="../styles/archives.css">


<?php 
  require("../layout/navbar.php");
?>

<section name="cromaconten"> 
  <div class="contencroma">
    <div class="croma col-lg-12  col-ms-12">
    <?php
      include('../layout/archives.php');
    ?>
    </div>
  </div>
</section>

<div class="archives-structur">
  <div class="grid-container">
    <div class="row">
      <div class="act col-lg-2">
        <h5>archivos</h5>
        <p>total de archivos: %</p>
        <hr>
        <button class="btn btn-light" id="newDoc">nuevo documento</button>
        <script src="../js/gestionComplement.js"></script>
      </div>
      <div class="archives-conten col-lg-10">
        <h2>Documentos</h2>
        <div class="cards">
          <?php
            include_once("../php/preset/cardSelector.php")
          ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require ("../layout/footer.php"); ?>
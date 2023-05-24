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
      <div class="act col-lg-1">
        <p>Acciones</p>
      </div>
      <div class="archives-conten col-lg-10">
        <h2>Documentos</h2>
        <div class="cards">
          <?php
            include_once("../php/cardSelector.php")
          ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require ("../layout/footer.php"); ?>
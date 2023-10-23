<?php

require_once("../php/sesionval.php");

include "../php/class/personal.php";

?>

<?php require("../layout/head.php"); ?>

<link rel="stylesheet" href="../styles/archives.css">
<script type="text/javascript">
  document.title = "SADINSAI | Archivos";
</script>
<?php require("../layout/navbar.php"); ?>

<?php include '../layout/archives.php' ?>

<div class="archives-structur">
  <div class="grid-container">
    <div class="row">
      <div class="act col-lg-2">
        <?php
        if ($_GET['gestion'] == 1046) {
          echo '<style> .acciones{ display: none;}</style>';
          include('../layout/planillasOpciones.php');
        }
        ?>
        <div class="acciones">
          <h5>archivos</h5>
          <hr>
          <button class="btn btn-light" id="newDoc">nuevo documento</button>
          <script src="../js/gestionComplement.js"></script>
        </div>
      </div>
      <div class="archives-conten col-lg-10">
        <h4 id="tittleDoc">Documentos de
          <?php
          $ver = new Personal($_GET['carga']);
          echo $ver->getNombre() . ' ' . $ver->getApellido();
          ?>
        </h4>
        <hr style="border-color: #e7e7e7;" >
        <div class="cards d-flex" style="flex-wrap: wrap;">
          <?php
          include_once "../php/preset/cardSelector.php"
            ?>
        </div>
      </div>
    </div>
  </div>
</div>
<style>
  .conten-archives {
    position: relative;
    margin-top: 65px;
    margin-bottom: -5%;
    padding-bottom: 10px;
  }
</style>

<?php require("../layout/footer.php"); ?>
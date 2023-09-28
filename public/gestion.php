<?php require_once("../php/sesionval.php"); ?>

<?php require("../layout/head.php"); ?>

<link rel="stylesheet" href="../styles/archives.css">
<script type="text/javascript">
  document.title = "SADINSAI | Archivos";
</script>
<?php require("../layout/navbar.php"); ?>

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
        <h2 id="tittleDoc">Documentos</h2>
        <div class="cards d-flex" style="flex-wrap: wrap;">
          <?php
          include_once("../php/preset/cardSelector.php")
            ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require("../layout/footer.php"); ?>
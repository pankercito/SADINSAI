<?php require_once "../php/sesionval.php"; ?>

<?php require "../layout/head.php" ?>

<link rel="stylesheet" href="../styles/archives.css">

<script type="text/javascript">
  document.title = "SADINSAI | Archivos";
</script>

<?php require "../layout/navbar.php" ?>

<?php include '../layout/archives.php' ?>

<div class="archives-structur">
  <div class="grid-container">
    <div class="row">
      <div class="act col-lg-2">
        <?php
        if ($_GET['g'] == 1046) {
          ?>
          <style>
            .acciones {
              display: none;
            }
          </style>
          <?php
          include "../layout/planillasOpciones.php";
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
        <h4 id="tittleDoc">
          <?php
          $conn = new Conexion;
          $ver = new Empleado($conn->real_escape($_GET['c']));
          $get = $conn->real_escape($_GET['g']);

          $pero = $conn->query("SELECT nombre_tipo_arch FROM `tiposarch` WHERE id_tipo ='$get'");

          if ($pero->num_rows > 0) {
            echo $pero->fetch_object()->nombre_tipo_arch . " de " . $ver->nombre . ' ' . $ver->apellido;
          }else {
            echo "FORMULARIO";
          }
          ?>
        </h4>
        <hr style="border-color: #e7e7e7;">
        <div class="cards d-flex" style="flex-wrap: wrap;">
          <?php

          include_once "../php/preset/cardSelector.php";

          if ($_GET['g'] == 1046) {
            include "../layout/planillas.php";
          }

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

<?php require "../layout/footer.php" ?>
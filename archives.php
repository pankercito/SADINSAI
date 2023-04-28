<?php
  require_once ("php/sesionval.php");
?> 

<?php 
  require ("layout/head.php");
?>

<link rel="stylesheet" href="styles/archives.css">
<link rel="stylesheet" href="styles/cards.css">

<?php 
  require("php/adp.php");
?>

<section name="cromaconten"> 
  <div class="contencroma">
    <?php
      include ("layout/archives.php");
    ?>
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
          $c = 0;
          while ( $c != 10){  
            echo '
            <div class="card">
              <div class="card__image-holder">
                <img class="card__image" src="https://picsum.photos/298/225?random='.rand(1, 10 ).'" alt="random" />
              </div>
              <div class="card-title">
                <a href="#" class="toggle-info btn">
                  <span class="left"></span>
                  <span class="right"></span>
                </a>
                <h2>
                  Titulo de tarjeta
                  <small>Subido el 02 del 92</small>
                </h2>
              </div>
              <div class="card-flap flap1">
                <div class="card-description">
                  This grid is an attempt to make something nice that works on touch devices. Ignoring hover states when they re not available etc.
                </div>
                <div class="card-flap flap2">
                  <div class="card-actions">
                    <a href="#" class="btn">¿Abrir o Editar?</a>
                  </div>
                </div>
              </div>
            </div>';
            
            $c++;
          }
        ?>

<script src="js/cards.js"></script>

<?php 
  require ("layout/footer.php");
?>


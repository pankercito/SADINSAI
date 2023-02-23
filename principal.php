<?php
  require_once ("php/sesionval.php");
?> 

<?php 
  require ("layout/head.php");
?>

<?php 
  require("php/adp.php");
?>
<!--SALUDO DE BIENVENIDA-->
<section name="cromaconten"> 
  <div class="contencroma">
    <?php
      include ("layout/sidebar.php");
    ?>
  </div>
</section>

<div class="estructur-conten">
  <div class="grid-containerr">
    <div class="row">
      <div class="col-lg-9">
        <?php 
          require_once ("php/seleccion.php");
        ?>
      </div>
      <div class="col-lg-3">
        <p>Informacion extra</p>
      </div>
      </div>
    </div>
  </div>
</div>

<?php 
  require ("layout/footer.php");
?>


<?php 
  require ("layout/head.php");
?>
<?php
  require_once ("php/sesionval.php");
?> 
<?php 
  require("php/adp.php");
?>

<!--SALUDO DE BIENVENIDA-->
<marquee class="welcome" behavior="scroll" direction="right" width="600 px"> 
  <p>
    <?php
      echo 'Bienvenido '.$wname.' '.$wlastname.'';
    ?>
  </p>
</marquee>

<div class="containerr">
  <div class="grid-containerr">
    <div class="row">
      <?php 
        require ("layout/sidebar.php");
      ?>
      <?php 
        require_once ("php/seleccion.php");
      ?>
      <div class="col-lg-3"></div>
      </div>
    </div>
  </div>
</div>

<?php 
  require ("layout/footer.php");
?>


<?php 
  require ("layout/head.php")
?>
<?php
  require ("php/sesionval.php")
?>
  
<?php 
  if ($adpval == 1) {
    require ("layout/navbar-ad.php");
  } else {
    require ("layout/navbar.php");
  }
?>

<!--SALUDO DE BIENVENIDA-->
<marquee class="welcome" behavior="scroll" direction="right" width="600 px"> 
  <p>
    <?php
      echo "Bienvenido ".$usuarioingresado
    ?>
  </p>
</marquee>

<div class="containerr">
  <div class="grid-containerr">
    <div class="row">
      <?php 
        require ("layout/sidebar.php")
      ?>
      <?php 
        if(isset($_GET["registrar"])){
          include ("layout/registrar.php");
        } else{
          include ("layout/perfil.php");
        }
      ?>
      <div class="col-lg-3"></div>
      </div>
    </div>
  </div>
</div>

<?php 
  require ("layout/footer.php")
?>


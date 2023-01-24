<?php 
  require ("layout/head.php")
?>
<?php
  require ("php/sesionval.php")
?>
  
<?php 
  require ("layout/navbar.php")
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
      <div class="col-lg-1"></div>
        <?php 
          require ("layout/perfil.php")
        ?>
      <div class="col-lg-2"></div>
    </div>
  </div>
</div>

<?php 
  require ("layout/footer.php")
?>


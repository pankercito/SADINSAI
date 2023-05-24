<?php
  require_once ("../php/sesionval.php");
?> 

<?php 
  require ("../layout/head.php");
?>

<?php 
  require("../layout/navbar.php");
?>
<!--SALUDO DE BIENVENIDA-->
<section name="cromaconten"> 
  <div class="contencroma">
    <?php
      include ("../layout/sidebar.php");
    ?>
  </div>
</section>

<div class="estructur-conten">
  <div class="grid-containerr">
    <div class="row">
      <div class="col-lg-9">
        <?php 
        $no_get = strtok($_SERVER['REQUEST_URI'], '?');

        echo $no_get;
        ?>
      </div>
     </div>
    </div>
  </div>
</div>

<?php require ("../layout/footer.php"); ?>
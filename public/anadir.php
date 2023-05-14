<?php
  require_once ("../php/sesionval.php");
?> 
<?php
    require("../layout/head.php");
?>
<link rel="stylesheet" href="../styles/regiform.css">
<link rel="stylesheet" href="../styles/anadir.css">
<?php
    include("../layout/navbar.php");
?>

<section name="cromaconten"> 
  <div class="contencroma">
    <?php
      include ("../layout/sidebar.php");
    ?>
  </div>
</section>

<div class="structur-conten">
   <div class="first row">
         <div class="col-2">
            <div class="contenido"></div>
            <p>Personal</p>
            <a class="añadir btn btn-primary" type="button" href="?form=true">Agregar personal</a>
               <?php
               if($adpval == 1){
                  include('../layout/accsadmin.php');
               }else{

               }
            ?>
         </div>
         <div class="col-7">
            <div class="contenido">
               <p>Contenido</p>
               <?php
                  include('../php/seleccionAnadir.php');
               ?>
            </div>
         </div>
         <div class="col-3">
            <div class="opcions"> 
               <p>Acciones</p>
            </div>
         </div>
   </div>
</div>
<?php require_once ("../php/sesionval.php"); ?> 

<?php require ("../layout/head.php"); ?>

<?php include("../layout/navbar.php"); ?>

<link rel="stylesheet" href="../styles/regiform.css">
<link rel="stylesheet" href="../styles/anadir.css">
<link rel="stylesheet" href="../styles/background.css">

<section name="cromaconten"> 
  <div class="contencroma">
    <?php
      include ("../layout/sidebar.php");
    ?>
  </div>
</section>

<div class="structur-conten">
   <div class="first row">
         <div class="fixed col-3">
            <div class="fijo contenido">
               <p>Personal</p>
               <div class="ations">
                  <a class="añadir btn btn-primary" type="button" href="?form=true">
                     <i class="bi bi-person-add"></i> Agregar personal
                  </a>
               </div>
                  <?php
                     if($adpval == TRUE){
                        include('../layout/accsadmin.php');
                     }else{

                     }
                  ?>
            </div>
         </div>
         <div class="conten col-8">
            <div class="contenido">
               <p>Contenido</p>
               <?php
                  include('../php/preset/seleccionAnadir.php');
               ?>
            </div>
         </div>
         <!-- <div class="action col-2">
            <div class="opcions"> 
               <p>Acciones</p>
            </div>
         </div> -->
   </div>
</div>

<?php require ("../layout/footer.php"); ?>
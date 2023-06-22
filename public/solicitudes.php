<?php require_once ("../php/sesionval.php"); ?> 

<?php require ("../layout/head.php"); ?>

<?php require("../layout/navbar.php"); ?>

<?php require("../php/funtion/adminSet.php"); ?>

<link rel="stylesheet" href="../styles/nomina.css">
<link rel="stylesheet" href="../styles/solicitudes.css">

<!--SALUDO DE BIENVENIDA-->
<section name="cromaconten"> 
  <div class="contencroma">
    <?php include ("../layout/sidebar.php");?>
  </div>
</section>


<div class="estructur-solicitudes">
	<div class="grid-containerr">
		<div class="row">
			<div class="action col-lg-3">
        		<div class="conten">
					<p class="n-inf">Filtrar</p>
					<div class="tb_search">
						<input type="text" id="<?php imprime("adminSearch", "userSearch")?>" onkeyup="<?php imprime("FiltroAdmin()", "FiltroUser()")?>" placeholder="Buscar..." class="form-control">
        			</div>
					<div class="ramas">
						<?php imprime("", '<a href="?solicitud=true" class="direccion btn btn-warning">Nueva solicitud</a>') ?>
					</div>
				</div>
      		</div>	
			<div id="notificacion"></div>
				<?php include("../php/preset/notificacion.php");?>
    		<div class="n-estructure col-lg-9">
    	    	<p class="ttl-dashboard">Solicitudes</p>
				<?Php include("../php/preset/seleccionSolicitud.php")?>
    	    	<div class="container">	
					<?php incluir("../layout/solicitudAdmin.php", "../layout/solicitudUser.php")?>
				</div>
			</div>
		</div>
    </div>
</div>
<script src="../js/search.js"></script>

<?php require ("../layout/footer.php"); ?>
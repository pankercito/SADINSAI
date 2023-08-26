<?php require_once("../php/sesionval.php"); ?> 

<?php require ("../layout/head.php"); ?>

<?php require("../layout/navbar.php"); ?>

<?php require("../php/function/adminSet.php"); ?>

<link rel="stylesheet" href="../styles/viewtables.css">
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
			<div id="notificacion">
				<?php include("../php/preset/notificacion.php");?>
			</div>	
    		<div class="n-estructure col-lg-9">
    	    	<p class="ttl-dashboard">Solicitudes</p>
    	    	<div class="container">	
					<?php incluir("../layout/solicitudAdmin.php", "../layout/solicitudUser.php")?>
				</div>
				<script type="text/javascript">
						new DataTable('#table-id', {
							autoWidth: false,
							order: [
								[ 3, 'desc' ]
							],
							language: {
								"decimal": "",
								"emptyTable": "No hay información",
								"info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
								"infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
								"infoFiltered": "(Filtrado de _MAX_ total entradas)",
								"infoPostFix": "",
								"thousands": ",",
								"lengthMenu": "Mostrar _MENU_ Entradas",
								"loadingRecords": "Cargando...",
								"processing": "Procesando...",
								"search": "Buscar:",
								"zeroRecords": "Sin resultados encontrados",
								"paginate": {
									"first": "Primero",
									"last": "Ultimo",
									"next": "Siguiente",
									"previous": "Anterior"
								}
							}
						});
					</script>
			</div>
		</div>
    </div>
</div>
<script src="../js/solicitudDetails.js"></script>
<script src="../js/search.js"></script>

<?php require ("../layout/footer.php"); ?>
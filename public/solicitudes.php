<?php require_once("../php/sesionval.php"); ?>

<?php require("../layout/head.php"); ?>

<?php require("../layout/navbar.php"); ?>

<link rel="stylesheet" href="../styles/viewtables.css">
<link rel="stylesheet" href="../styles/nomina.css">
<link rel="stylesheet" href="../styles/solicitudes.css">

<!--SALUDO DE BIENVENIDA-->
<section name="cromaconten">
	<div class="contencroma">
		<?php include("../layout/sidebar.php"); ?>
	</div>
</section>

<div class="estructur-solicitudes">
	<div class="grid-containerr">
		<div class="row">
			<div id="notificacion">
				<?php include("../php/preset/notificacion.php"); ?>
			</div>
			<div class="n-estructure col">
				<p class="ttl-dashboard">Solicitudes</p>
				<div class="container">
					<?php incluir("../layout/solicitudAdmin.php", "../layout/solicitudUser.php") ?>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="../js/solicitudes.js"></script>

<?php require("../layout/footer.php"); ?>
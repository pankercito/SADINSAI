<?php require_once("../php/sesionval.php"); ?>

<?php require("../layout/head.php"); ?>

<?php require("../layout/navbar.php"); ?>

<link rel="stylesheet" href="../styles/viewtables.css">
<link rel="stylesheet" href="../styles/nomina.css">
<link rel="stylesheet" href="../styles/solicitudes.css">

<!--SALUDO DE BIENVENIDA-->
<?php include("../layout/sidebar.php"); ?>
<!-- notificacion script -->
<?php include "../php/preset/notificacion.php"; ?>

<div class="estructur-solicitudes">
	<div class="grid-containerr">
		<div class="row">
			<div class="n-estructure col">
				<h4 class="mx-auto mb-2" style="color: #e7e7e7;">GESTION DE DATOS DEL PERSONAL</h4>
				<hr style="border-color:white;">
				<div class="container mt-4">
					<?php incluir("../layout/solicitudAdmin.php", "../layout/solicitudUser.php") ?>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="../js/solicitudes.js"></script>

<?php require("../layout/footer.php"); ?>
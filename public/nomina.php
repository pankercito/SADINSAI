<?php require_once("../php/sesionval.php"); ?>

<?php require("../layout/head.php"); ?>

<?php include("../layout/navbar.php"); ?>
<link rel="stylesheet" href="../styles/nomina.css">


<!--SALUDO DE BIENVENIDA-->
<section name="cromaconten">
	<div class="contencroma">
		<?php
		include("../layout/sidebar.php");
		?>
	</div>
</section>

<div class="estructur-nomina">
	<div class="grid-containerr">
		<div class="row">
			<div class="n-estructure col-lg-9">
				<p class="ttl-dashboard">Nomina Pagos 15nales</p>
				<div class="container">
					<table id="example" class="ui celled table">
						<thead>
							<tr>
								<th>Nombre</th>
								<th>Cedula</th>
								<th>Telefono</th>
								<th>Cargo</th>
								<th>Pagos</th>
								<th>Monto</th>
							</tr>
						</thead>
						<tbody>
							<?php
							///datos randoms para pruebas 
							$cargo = array(
								1 => "rashos",
								2 => "medico",
								3 => "rata",
								4 => "guao",
								5 => "raritos",
							);

							$i = 0;
							while ($i != 58) {
								$c = rand(1, 5);
								$lol = rand(500, 5000);
								$lmo = rand(1, 31);
								$ci = rand(01111111, 99999999);
								echo "
									<tr>
										<td>Rajah Armstrong</td>
										<td>" . $ci . "</td>
										<td>041212345" . $i++ . "</td>
										<td>" . $cargo[$c] . "</td>
										<td>dic" . $lmo . ", 2023</td>
										<td>" . $lol . " Bs.</td>
									</tr>";
							}
							?>
						</tbody>
						<tfoot>
							<tr>
								<th>Nombre</th>
								<th>Cedula</th>
								<th>Telefono</th>
								<th>Cargo</th>
								<th>Pagos</th>
								<th>Monto</th>
							</tr>
						</tfoot>
					</table>
					<script type="text/javascript">
						new DataTable('#example', {
							autoWidth: false,
							select: true,
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
</div>

<?php require("../layout/footer.php"); ?>
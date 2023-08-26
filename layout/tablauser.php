<style>
.estructur-conten {
    margin: 2%;
    margin-top: 2rem;
}
</style>

<?php include('../php/adp.php')?>

<div class="registersuser">
    <table class="table table-light table-striped table-sm w-auto data" id="users">
        <thead class="table-light">
            <tr>
                <th class="text-end"><a>usuario</a></th>
                <th class="text-end"><a>Nombre</a></th>
                <th class="text-end"><a>Apellido</a></th>
                <th class="text-end"><a>Cedula</a></th>
            </tr>
        </thead>
        <tbody>
            <?php include('../php/preset/viewRegister.php')?>
        </tbody>
        <script type="text/javascript">
					$('#users').DataTable({
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
    </table>
</div>
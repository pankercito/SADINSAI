<?php require_once ("../php/sesionval.php"); ?> 

<?php require ("../layout/head.php"); ?>

<?php include("../layout/navbar.php"); ?>
<link rel="stylesheet" href="../styles/nomina.css">

<!--SALUDO DE BIENVENIDA-->
<section name="cromaconten"> 
  <div class="contencroma">
    <?php
      include ("../layout/sidebar.php");
    ?>
  </div>
</section>

<div class="estructur-nomina">
	<div class="grid-containerr">
    	<div class="row">
	    	<div class="action col-lg-3">
    	    	<div class="conten">
					<p class="n-inf">Filtrar</p>
					<div class="tb_search">
						<input type="text" id="search_input_all" onkeyup="FilterkeyWord_all_table()" placeholder="Buscar..." class="form-control">
    	    		</div>
					<div class="num_rows">
						<div class="form-group"> <!-- Numeros de Paginacion-->
				 			<select class  ="form-control" name="state" id="maxRows">
								<option value="10">10</option>
								<option value="15">15</option>
								<option value="20">20</option>
								<option value="50">50</option>
								<option value="70">70</option>
								<option value="100">100</option>
    	        				<option value="5000">Show ALL Rows</option>
							</select>	
							<i class="bi bi-arrow-down-short"></i>	 		
						</div>
    	    		</div>
				</div>
    	  	</div>
    		<div class="n-estructure col-lg-9">
	        	<p class="ttl-dashboard">Dashboard</p>
    	    	<div class="container">	
					<table class="table table-striped table-class" id="table-id">	
						<thead>
							<tr>
								<th>Nombre</th>
								<th>Cedula</th>
								<th>Telefono</th>
								<th>Pagos</th>
								<th>Monto</th>
							</tr>
  						</thead>
						<tbody>
							<?php
							///datos randoms para pruebas 
								$i = 0;
								while($i!=58){
									$lol = rand(500, 5000);
									$lmo = rand(1, 31);
									$ci  = rand(01111111, 99999999);
									echo "
									<tr>
										<td>Rajah Armstrong</td>
										<td>".$ci."</td>
										<td>041212345".$i++."</td>
										<td>Oct ".$lmo.", 2023</td>
										<td>".$lol."</td>
									</tr>";
								}
							?>
    					</tbody>
					</table>
			  		<div class='pagination-container'>
						<nav>
							<ul class="pagination">
								<script src="../js/nomina.js"></script>
							</ul>
						</nav>
					</div>
    	  			<div class="rows_count">
						Mostrando 11 a 20 de 24 entradas
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php require ("../layout/footer.php"); ?>
<?php require_once ("../php/sesionval.php"); ?> 

<?php require ("../layout/head.php"); ?>

<?php require("../layout/navbar.php"); ?>

<link rel="stylesheet" href="../styles/solicitudes.css">
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
        <p class="n-inf">Acciones</p>
		<div class="tb_search">
			<input type="text" id="search_input_all" onkeyup="FilterkeyWord_all_table()" placeholder="Search.." class="form-control">
        </div>
		<div class="num_rows">
			<div class="form-group"> 	<!--		Show Numbers Of Rows 		-->
			 	<select class  ="form-control" name="state" id="maxRows">		 
					<option value="10">10</option>
					<option value="15">15</option>
					<option value="20">20</option>
					<option value="50">50</option>
					<option value="70">70</option>
					<option value="100">100</option>
            		<option value="5000">Show ALL Rows</option>
				</select>
			 		
			</div>
        </div>
      </div>
    <div class="n-estructure col-lg-9">
        <p class="ttl-dashboard">Solicitudes</p>
        <div class="container">	
			<table class="table table-striped table-class" id="table-id">	
				<thead>
					<tr>
			      		<th>Solicitud</th>
			      		<th>fecha</th>
			    		<th>Motivo</th>
            			<th>Estado</th>
		  			</tr>
  				</thead>
	      		<tbody>
		      		<tr>
			    		<td>002</td>
			    		<td>2021-06-02 15:45:00</td>
			    		<td>Eliminación de registro</td>
			    		<td>Aceptada</td>
		      		</tr>
		      		<tr>
			    		<td>003</td>
			    		<td>2021-06-03 09:20:00</td>
			    		<td>Cambio de número de teléfono</td>
			    		<td>Rechazada</td>
		      		</tr>
					<tr>
			    		<td>004</td>
			    		<td>2021-06-04 09:20:00</td>
			    		<td>Cambio de registro</td>
			    		<td>Pendiente</td>
		      		</tr>
	     		</tbody>
			</table>
		</div>
	</div>
	</div>
      </div>
    </div>
  </div>
</div>

<?php require ("../layout/footer.php"); ?>
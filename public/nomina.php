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
					<p class="n-inf">Acciones</p>
					<div class="tb_search">
						<input type="text" id="search_input_all" onkeyup="FilterkeyWord_all_table()" placeholder="Search.." class="form-control">
    	    		</div>
					<div class="num_rows">
						<div class="form-group"> <!--		Show Numbers Of Rows 		-->
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
    	  	</div>
    		<div class="n-estructure col-lg-9">
	        	<p class="ttl-dashboard">Dashboard</p>
    	    	<div class="container">	
					<table class="table table-striped table-class" id="table-id">	
						<thead>
							<tr>
								<th>Name</th>
								<th>Email</th>
								<th>Phone</th>
								<th>Date</th>
							</tr>
  						</thead>
						<tbody>
							<?php 
								$i = 0;

								while($i!=58){
									echo "
									<tr>
										<td>Rajah Armstrong</td>
										<td>erat.neque@noncursusnon.ca</td>
										<td>1-636-140-".$i++."</td>
										<td>Oct 26, 2023</td>
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
<?php 
  require ("php/head.php")
?>
<?php
  include ("php/sesionval.php")
?>

  <style> 
    body{
      -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      background-size: cover;
    }   
    
  </style>
  
  <?php 
    require ("php/navbar.php")
  ?>
  
  <marquee class="welcome" behavior="scroll" direction="right" width="600 px"><!--SALUDO DE BIENVENIDA--> 
    <p>
      <?php
        echo "Bienvenido ".$usuarioingresado
      ?>
    </p>
  </marquee>
  
  
  <div class="containerr">
   <div class="grid-containerr">
    <div class="row">
      <div class="col-lg-2"> <!--COLUMNA #1/PARA CATEGORIAS-->
         <p>Categorias<p>
         <div class="listcatg">
          <ul>
            <li><a class="nav-link" href="#">Ofertas y servicios</a></li>
            <li><a class="nav-link" href="#">Movimientos</a></li>
            <li><a class="nav-link" href="#">Doc. de eduación y experiencia</a></li>
            <li><a class="nav-link" href="#">Evaluaciones</a></li>
            <li><a class="nav-link" href="#">Beneficios</a></li>
            <li><a class="nav-link" href="#">Permisos</a></li>
            <li><a class="nav-link" href="#">Control de pasivo laboral</a></li>
            <li><a class="nav-link" href="#">Varios</a></li>
            <li><a class="nav-link" href="#">Memorando</a></li>
            <li><a class="nav-link" href="#">Sanciones y procedimientos administrativos y judiciales</a></li>
          </ul>      
        </div>
      </div>
      <div class="col-lg-1"></div>
      <div class="col-lg-5"> <!--COLUMNA #2/PARA PERFIL BÁSICO DEL USUARIO-->
        <p>Perfil<p>
        <div class="perfil">
          <div class="col-lg">
          </div>
          <div class="col-sm">
            <p>Nombre</p><input type="text" class="form-control" id="Nombre"></input>
          </div>
          <div class="row">
            <div class="form-group col-sm">
              <p>Cedúla</p><input type="text" class="form-control" id="Cedula"></input>
            </div>
            <div class="form-group col-sm">
              <p>dirección</p><input type="text" class="form-control" id="Direccion"></input>
            </div>
          <div class="col-sm"></div>
          <div class="row">
            <div class="form-group col-sm">
                <p>Número de teléfono</p><input type="text" class="form-control" id="telefono"></input>
            </div>
            <div class="form-group col-sm">
                <p>Estado</p><input type="text" class="form-control" id="Estado"></input>
            </div>
            <div class="form-group col-sm">
              <p>Cargo</p><input type="text" class="form-control" id="Cargo"></input>
            </div>
            <div class="form-group col-sm">
              <p>Ciudad</p><input type="text" class="form-control" id="Ciudad"></input>
            </div>
          </div>          
        </div>
      </div>
      <div class="col-lg-2">
      </div>
    </div>
  </div>

<?php 
include ("php/footer.php")
?>



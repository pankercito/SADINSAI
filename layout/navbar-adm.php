<header>
<section name="navbar"><!--MENU DE NAVEGACION ADMIN-->
<script src="js/activenavbar.js"></script>
<div class="navbarconten"> 
    <nav class="nav navbar-light"><!--BARRA DE NAVEGACION BG-->
      <a class="navbar-brand" href="../sadinsai/principal.php?perfil=<?php echo $wci?>">
        <img src="recursos/favsadin.png" width="100" alt="Logo"><!--LOGO DE SADINSAI-->
      </a>
      <nav class="navbar-nav">
        <!--LISTA DE NAVEGACION--> 
        <ul class="nav nav-list nav-pills navbar-right">
          <!--ELEMENTOS DE LA LISTA DE NAVEGACION-->
          <li class="nav-item">
            <a data-position="1" class="nav-link" href="principal.php?perfil=<?php echo $wci?>">Inicio</a>
          </li>
          <li class="nav-item">
            <a data-position="2" class="nav-link" href="principal.php?states=true">Estados</a>
          </li>
          <li class="nav-item">
            <a data-position="3" class="nav-link" href="nomina.php?nomina=true">Nomina</a>
          </li>
          <li class="nav-item">
            <a data-position="4" class="nav-link" href="principal.php?users=true">Usuarios</a>
          </li>
          <li class="nav-item">
            <a data-position="5"class="nav-link" href="#">Reportes</a>
          </li>
        </ul>
      </nav>
      <form class="form-inline">
        <!--BARRA DE BUSQUEDA--> 
        <input id="searchbar" class="form-control" type="search" placeholder="Buscar...">
        </input>
        <!--BOTON DE BUSQUEDA-->
        <button id="search" class="btn btn-outline-success" type="submit" name="keyworks">
          <i class="bi bi-search"></i><!--ICONO-->
        </button>
        <span class="input-group-text" id="basic-addon1"></span><!--SEPARADOR--> 
        <!--BOTON DE AYUDA--> 
        <button id="help" class="btn btn-info btn-default" href="#">
          <i class="bi bi-question-lg"></i><!--ICONO-->
        </button>
        <span class="input-group-text" id="basic-addon1"></span><!--SERPARADOR-->
        <!--BOTO DE CERRAR SESION--> 
        <a id="close" class="btn" href="../sadinsai/php/cerrar.php">
          <i class="bi bi-box-arrow-in-right"> Salir</i><!--ICONO-->
        </a>
      </form>
    </nav>
  </div>
</section>
<style>/*ESTILO EXTRA DE ADMIN*/
    .nav-item .nav-link {/*listado*/
    padding-left: 20px;
    padding-right: 20px;
}
</style>
</header>
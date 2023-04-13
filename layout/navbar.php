<header>
<section name="navbar"><!--MENU DE NAVEGACION ADMIN-->

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
            <a class="nav-link" href="principal.php?perfil=<?php echo $wci?>">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="principal.php?states=true">Estados</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="nomina.php?nomina=true">Nomina</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Reportes</a>
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
  .navbar-nav{/*lista de navegacion*/
    margin-left: -25%;
  }
</style>
</header>
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
            <a class="nav-link" href="?perfil=<?php echo $wci?>">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?states=true">Estados</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Formulario</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?users=true">Usurarios</a>
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
<<<<<<< HEAD
        <button id="search" class="btn btn-outline-success" type="submit" name="keyworks">
=======
        <button class="btn btn-outline-success" type="submit" name="keyworks">
>>>>>>> ef454668b094ed648e94e17d925e51a7f585f6bd
          <i class="bi bi-search"></i><!--ICONO-->
        </button>
        <span class="input-group-text" id="basic-addon1"></span><!--SEPARADOR--> 
        <!--BOTON DE AYUDA--> 
<<<<<<< HEAD
        <button id="help" class="btn btn-info btn-default" href="#">
=======
        <button  class="btn btn-info btn-default" href="#">
>>>>>>> ef454668b094ed648e94e17d925e51a7f585f6bd
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
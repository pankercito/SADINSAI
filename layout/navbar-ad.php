<section class="navmenubar"><!--MENU DE NAVEGACION-->

  <div class="sidebar"> 
    <nav class="nav navbar-light">
      <a class="navbar-brand" href="../sadinsai/principal.php">
        <img src="recursos/favsadin.png" width="100" alt="Logo">
      </a>
      <nav class="navbar-nav">
        <ul class="nav nav-list nav-pills navbar-right">
          <li class="nav-item">
            <a class="nav-link" href="#">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Estados</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Formulario</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?registrar=true">Registrar</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Reportes</a>
          </li>
        </ul>
      </nav>
      <form class="form-inline">
        <input id="searchbar" class="form-control" type="search" placeholder="Buscar...">
        </input>
        <button class="btn btn-outline-success" type="submit" name="keyworks">
          <i class="bi bi-search"></i>
        </button>
        <span class="input-group-text" id="basic-addon1"></span>
        <button  class="btn btn-info btn-default" href="#">
          <i class="bi bi-question-lg"></i>
        </button>
        <span class="input-group-text" id="basic-addon1"></span>  
        <a id="close" class="btn" href="../sadinsai/php/cerrar.php">
          <i class="bi bi-box-arrow-in-right"></i> Salir
        </a>
      </form>
    </nav>
  </div>
</section>
<style>
    .nav-item .nav-link {/*listado*/
    padding-left: 20px;
    padding-right: 20px;
}
</style>
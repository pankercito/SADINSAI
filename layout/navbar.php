<script src="../js/autoCerrarSesion.js"></script>
<header>
    <section name="navbar"><!--MENU DE NAVEGACION ADMIN-->
        <script src="../js/activenavbar.js"></script>
        <div class="navbarconten">
            <nav class="nav navbar-light"><!--BARRA DE NAVEGACION BG-->
                <a class="navbar-brand" href="perfil.php?perfil=<?php echo $wci ?>">
                    <!--LOGO DE SADINSAI-->
                    <img src="../resources/favsadin.png" width="100" alt="Logo">
                </a>
                <script>
                    // carta de hover
                    $(".navbar-brand").hover(function () {
                        $(this).append('<span class="Msg btn btn" style="background: #ff6384; color: white;  position: absolute; margin: -.8rem 0rem 0 -1.5rem;height: 1.5rem; font-size: 12px;padding: 0px 8px; ">Ver mi perfil</span>');
                    }, function () {
                        $(this).children(".Msg").remove();
                    });
                </script>

                <?php
                if ($adpval == 1) {
                    ?>
                    <script>
                        // carta de hover
                        $(".navbar-brand").append('<span id="adminSetMsj" class="btn btn">admin</span>');

                    </script>
                    <?php
                } else if ($adpval == 2) {
                    ?>
                        <script>
                            // carta de hover
                            $(".navbar-brand").append('<span id="sysAdminSetMsj" class="btn btn">sysAdmin</span>');

                        </script>
                    <?php
                }
                ?>

                <nav class="navbar-nav">
                    <!--LISTA DE NAVEGACION-->
                    <ul class="nav nav-list nav-pills navbar-right">
                        <!--ELEMENTOS DE LA LISTA DE NAVEGACION-->
                        <li class="nav-item">
                            <?php echo selectPrint('<a data-position="1" class="nav-link" href="principal.php">Inicio</a>', '<a data-position="1" class="nav-link" href="perfil.php?perfil=' . $wci . '">Inicio</a>', '<a data-position="1" class="nav-link" href="sysAdmin.php">Inicio</a>') ?>
                        </li>
                        <li class="nav-item">
                            <a data-position="2" class="nav-link" href="estados.php">Personal</a>
                        </li>
                        <li class="nav-item">
                            <a data-position="3" class="nav-link" href="anadir.php">A&ntilde;adir</a>
                        </li>
                        <li class="nav-item">
                            <a data-position="4" class="nav-link" href="solicitudes.php">Solicitudes</a>
                        </li>
                    </ul>
                </nav>
                <form class="searchito d-flex">
                    <!--BARRA DE BUSQUEDA-->
                    <input id="searchbar" class="form-control" type="search" placeholder="Buscar..." autocomplete="off"
                        onkeyup="searching()">
                    </input>
                    <!--BOTON DE BUSQUEDA-->
                    <button id="search" class="btn" disabled>
                        <i class="bi bi-search"></i><!--ICONO-->
                    </button>
                    <div id="result" class="resultsearch d-none">
                        <ul id="resultList">

                        </ul>
                    </div>
                    <span class="input-group-text" id="basic-addon1"></span><!--SEPARADOR-->
                    <!--BOTON DE AYUDA-->
                    <button id="help" class="btn btn-info btn-default" href="#">
                        <i class="bi bi-question-lg"></i><!--ICONO-->
                    </button>
                    <span class="input-group-text" id="basic-addon1"></span><!--SERPARADOR-->
                    <!--BOTO DE CERRAR SESION-->
                    <a id="close" class="btn" href="../php/cerrarSesion.php">
                        <i class="bi bi-box-arrow-in-right"> Salir</i><!--ICONO-->
                    </a>
                </form>
            </nav>
        </div>
    </section>
</header>
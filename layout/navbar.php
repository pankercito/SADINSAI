<script src="../js/autoCerrarSesion.js"></script>
<header>
    <section name="navbar"><!--MENU DE NAVEGACION ADMIN-->
        <script src="../js/activenavbar.js"></script>
        <div class="navbarconten">
            <nav class="nav navbar-light"><!--BARRA DE NAVEGACION BG-->
                <a class="navbar-brand" href="../public/perfil.php?perfil=<?php echo $wci ?>">
                    <!--LOGO DE SADINSAI-->
                    <img src="../resources/favsadin.png" width="85" alt="Logo">
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
                        $(".navbar-brand").append('<span id="adminSetMsj" class="btn btn">Jefe de departamento</span>');

                    </script>
                    <?php
                } else if ($adpval == 2) {
                    ?>
                        <script>
                            // carta de hover
                            $(".navbar-brand").append('<span id="sysAdminSetMsj" class="btn btn">DIR. TECNOLOGIA</span>');

                        </script>
                    <?php
                } else {
                    ?>
                        <script>
                            // carta de hover
                            $(".navbar-brand").append('<span id="analistSetMsj" class="btn btn">ANALISTA</span>');

                        </script>
                    <?php
                }
                ?>

                <nav class="navbar-nav">
                    <!--LISTA DE NAVEGACION-->
                    <ul class="nav nav-list nav-pills navbar-right">
                        <!--ELEMENTOS DE LA LISTA DE NAVEGACION-->

                        <li class="nav-item">
                            <?php echo selectPrint('<a data-position="1" class="nav-link" href="../public/principal.php">Inicio</a>', '<a data-position="1" class="nav-link" href="perfil.php?perfil=' . $wci . '">Inicio</a>', '<a data-position="1" class="nav-link" href="../public/sysAdmin.php">Inicio</a>') ?>
                        </li>
                        <li class="nav-item">
                            <a data-position="2" class="nav-link" href="../public/personal.php">Personal</a>
                        </li>
                        <li class="nav-item">
                            <a data-position="3" class="nav-link" href="../public/anadir.php">A&ntilde;adir</a>
                        </li>
                        <li class="nav-item">
                            <a data-position="4" class="nav-link" href="../public/solicitudes.php">Solicitudes</a>
                        </li>
                        <li class="nav-item">
                            <a data-position="5" class="nav-link" href="../public/gestionData.php">Gestion de Datos</a>
                        </li>
                        <li class="nav-item">
                            <a data-position="6" class="nav-link d-none">oculto</a>
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
                    <?php
                    if ($adpval == 0) {
                        ?>
                        <a id="help" class="btn" type="button" href="#" target="_blank">
                            <i class="bi bi-question-lg"></i>
                        </a>
                        <?php
                    } else {
                        ?>
                        <button id="help" class="btn" type="button" id="triggerId" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="bi bi-list"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-dark" aria-labelledby="triggerId">
                            <a class="dropdown-item" href="../components/cargos.php">Cargo <i
                                    class="estrate bi bi-diagram-3-fill"></i></a>
                            <a class="dropdown-item" href="../components/sedes.php">Sedes <i
                                    class="estrate bi bi-geo-fill"></i></a>
                            <a class="dropdown-item" href="../private/backRec.php">Respalo/Restaurcion <i
                                    class="estrate bi bi-database-fill-gear"></i></a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Manual de usuario <i
                                    class="estrate bi bi-journal-medical"></i></a>
                        </div>
                        <?php
                    }
                    ?>

                    <span class="input-group-text" id="basic-addon1"></span><!--SERPARADOR-->
                    <!--BOTO DE CERRAR SESION-->
                    <a id="close" class="btn" href="../php/cerrarSesion.php">
                        <i class="bi bi-box-arrow-in-right"> Salir</i><!--ICONO-->
                    </a>
                </form>
            </nav>
            <style>
                .estrategi {
                    font-size: 16px;
                }


                a.dropdown-item:hover {
                    margin-right: 0;
                    margin-left: 10px;
                    background: #e7e7e7;
                    color: black;
                }

                .dropdown-item {
                    padding: 12px;
                    /* margin-left: 10px; */
                    margin-right: 10px;
                    font-family: monospace, Segoe UI !important;
                    font-size: 16px !important;
                }
            </style>
        </div>
    </section>
</header>
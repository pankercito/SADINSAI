<div class="centro col-lg-12" id="centroEdit">
    <link rel="stylesheet" href="../styles/editarUsuarios.css">
    <div class="col">
        <button class="btn btn-light my-4" onclick="eback()">atras</button>
    </div>
    <?php
    include_once("../php/editSet.php");
    $_SESSION['editCI'] = $SetCi;
    ?>
    <div class="contenido1" id="editSet" display="none">
        <form action="../php/registroSolicitud.php" method="post" id="editForm" name="xdit">
            <h4>Editar perfil</h4>
            <div class="lmao row">
                <div class="one row">
                    <label for="Name">Nombre</label>
                    <input id="Name" name="name" type="text" value="<?php echo $SetName ?>">
                    <label for="Ci">Cedula</label>
                    <input id="Ci" name="cedi" type="int" onblur="verificarCI()" value="<?php echo $SetCi ?>" disabled>
                    <div id="mensajeCi"></div>
                </div>
                <div class="two row">
                    <label for="Apellido">Apellido</label>
                    <input id="Apellido" name="apellido" type="text" value="<?php echo $SetApellido ?>">
                    <label for="Phone">Telefono</label>
                    <input id="Phone" name="telefono" type="text" maxlength="11" value="<?php echo $SetPhone ?>">
                </div>
                <div class="two row">
                    <label for="Grado_Academico">Grado Academico</label>
                    <input id="Grado_Academico" name="grado_academico" type="text" maxlength="11"
                        value="<?php echo $SetGrado ?>">
                    <div class="col row">
                        <label>sexo
                            <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group"
                                style="margin: 0 0 0 -3rem;">
                                <input type="radio" class="btn-check" name="sexo" id="btncheck1" autocomplete="off"
                                    value="no especificado" checked>
                                <label class="radiohead btn btn-outline-secondary" for="btncheck1">no
                                    especificado</label>
                                <input type="radio" class="btn-check" name="sexo" id="btncheck2" autocomplete="off"
                                    value="femenino">
                                <label class="radiohead btn btn-outline-danger" for="btncheck2">femenino</label>
                                <input type="radio" class="btn-check" name="sexo" id="btncheck3" autocomplete="off"
                                    value="masculino">
                                <label class="radiohead btn btn-outline-primary" for="btncheck3">masculino</label>
                            </div>
                        </label>
                    </div>
                </div>
            </div>
            <div class="selects row">
                <div class="sel2">
                    <label for="Edad">Fecha de Nacimiento</label>
                    <input type="date" id="Edad" name="edad" value="<?php echo $SetFecha ?>">
                </div>
                <div class="sel2">
                    <label for="Cargo">Cargo</label>
                    <select id="Cargo" name="cargo">
                        <option value="0">- seleccionar cargo -</option>
                        <?php
                        include("../php/preset/CargosPre.php")
                            ?>
                    </select>
                </div>
            </div>
            <div class="selects row">
                <div class="sel1">
                    <label for="Estados">Estado</label>
                    <select id="Estados" name="estado">
                        <option value="0">- seleciona un Estado -</option>
                        <?php
                        include("../php/preset/stadosForm.php")
                            ?>
                    </select>
                </div>
                <div class="sel2">
                    <label for="Ciudades">Ciudad</label>
                    <select id="Ciudades" name="ciudad">
                        <option value="0">- Seleciona una ciudad -</option>
                    </select>
                </div>
            </div>
            <div class="lmao row">
                <div class="row">
                    <div class="sel3">
                        <label for="Sede">Sede</label>
                        <select id="Sede" name="sede">
                            <option value="0">- selecione su sede-</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="sel3">
                        <label for="ep">departamento</label>
                        <select id="ep" name="departament">
                            <option value="0">- selecione una opcion -</option>
                            <?php
                            include "../php/preset/opcionesD.php"
                                ?>
                        </select>

                    </div>
                </div>
            </div>
            <div class="lmao row">
                <div class="one row">
                    <label for="Email">Correo</label>
                    <input id="Email" name="email" type="text" value="<?php echo $SetEmail ?>">
                </div>
                <div class="two row">
                    <label for="Direccion">Direccion</label>
                    <input id="Direccion" name="direccion" type="text" value="<?php echo $SetDireccion ?>">
                </div>
            </div>
            <br>
            <input type="text" class="d-none" id="tipo" name="tipo" value="1">
            <button class="btn btn-lg btn-warning" id="log" type="submit" name="editLog">Solicitar
                cambio</button>
        </form>
        <script type="text/javascript">
            var idCar = <?php echo $SetIdCargo ?>;
            var idDep = <?php echo $SetIdDepart ?>;
            var idE = <?php echo $SetIdEstado ?>;
            var idC = <?php echo $SetIdCiudad ?>;
            var idS = <?php echo $SetIdSede ?>;
        </script>
    </div>
    <script type="text/javascript">
        var ds = "<?php echo $SetCi ?>";
        // Datos del formulario precargados
        const datosFormularioPre = {
            "nombre": "<?php echo strtolower($SetName) ?>".toLowerCase().trim(),
            "cedula": "<?php echo strtolower($SetCi) ?>".toLowerCase().trim(),
            "apellido": "<?php echo strtolower($SetApellido) ?>".toLowerCase().trim(),
            "grado": "<?php echo strtolower($SetGrado) ?>".toLowerCase().trim(),
            "sexo": "<?php echo strtolower($SetSexo) ?>".toLowerCase().trim(),
            "fecha": "<?php echo strtolower( $SetFecha) ?>".toLowerCase().trim(),
            "estado": "<?php echo strtolower($SetEstado) ?>".toLowerCase().trim(),
            "ciudad": "<?php echo strtolower($SetCiudad) ?>".toLowerCase().trim(),
            "sede": "<?php echo strtolower($SetSede) ?>".toLowerCase().trim(),
            "telefono": "<?php echo strtolower($SetPhone) ?>".toLowerCase().trim(),
            "email": "<?php echo strtolower($SetEmail) ?>".toLowerCase().trim(),
            "direccion": "<?php echo strtolower($SetDireccion) ?>".toLowerCase().trim(),
            "cargo": "<?php echo strtolower($SetCargo) ?>".toLowerCase().trim(),
            "departamento": "<?php echo strtolower($SetDepart) ?>".toLowerCase().trim()
        };
    </script>
    <script src="../js/editUserModal.js"></script>
</div>
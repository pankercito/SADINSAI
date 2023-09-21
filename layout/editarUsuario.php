<div class="centro col-lg-12" id="centroEdit">
    <link rel="stylesheet" href="../styles/editarUsuarios.css">
<div class="col">
    <button class="btn btn-light my-4" onclick="eback()" >atras</button>
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
                    <input id="Ci" name="ci" type="int" onblur="verificarCI()" value="<?php echo $SetCi ?>" disabled>
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
                    sexo
                    <div class="two row radio">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input radio" type="radio" name="sexo" id="inlineRadio1"
                                value="femenino">
                            <label class="form-check-label" for="inlineRadio1">femenino</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input radio" type="radio" name="sexo" id="inlineRadio2"
                                value="masculino" checked>
                            <label class="form-check-label" for="inlineRadio2">masculino</label >
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input radio" type="radio" name="sexo" id="inlineRadio3"
                                value="no especificado">
                            <label class="form-check-label" for="inlineRadio3">no especificado</label>
                        </div>
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
                <div class="sel3">
                    <label for="Sede">Sede</label>
                    <select id="Sede" name="sede">
                        <option value="0">- selecione su sede-</option>
                    </select>
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
            <button class="btn btn-lg btn-warning" id="log" type="submit" name="editLog">Solicitar cambio</button>
        </form>
        <script type="text/javascript">
            var idCar = <?php echo $SetIdCargo ?>;
            var idE = <?php echo $SetIdEstado ?>;
            var idC = <?php echo $SetIdCiudad ?>;
            var idS = <?php echo $SetIdSede ?>;
        </script>
    </div>
    <script type="text/javascript">
        var ds = "<?php echo $SetCi ?>";
        // Datos del formulario precargados
        const datosFormularioPre = {
            "nombre": "<?php echo $SetName ?>",
            "cedula": "<?php echo $SetCi ?>",
            "apellido": "<?php echo $SetApellido ?>",
            "grado_academico": "<?php echo $SetGrado ?>",
            "sexo": "<?php echo $SetSexo ?>",
            "fecha": "<?php echo $SetFecha ?>",
            "estado": "<?php echo $SetEstado ?>",
            "ciudad": "<?php echo $SetCiudad ?>",
            "sede": "<?php echo $SetSede ?>",
            "telefono": "<?php echo $SetPhone ?>",
            "email": "<?php echo $SetEmail ?>",
            "direccion": "<?php echo $SetDireccion ?>",
            "cargo": "<?php echo $SetCargo ?>"
            // Agrega aquí los demás campos del formulario
        };
    </script>
    <script src="../js/editUserModal.js"></script>
</div>
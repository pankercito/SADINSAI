<div class="contenido1">
    <form action="../php/registroSolicitud.php" method="post">
        <div class="lmao row">
            <div class="one row">
                <div class="mb-3"><label for="Name">Nombre</label>
                    <input id="Name" name="name" type="text">
                </div>
                <div class="mb-3"><label for="Ci">Cedula</label>
                    <input id="Ci" name="ci" type="num" onblur="verificarCI()">
                    <div id="mensajeCi"></div>
                </div>
            </div>
            <div class="two row">
                <div class="mb-3">
                    <label for="Apellido">Apellido </label>
                    <input id="Apellido" name="apellido" type="text">
                </div>
                <div class="mb-3">
                    <label for="Phone">Telefono </label>
                    <input id="Phone" name="telefono" type="text" maxlength="11">
                </div>
            </div>
            <div class="two row">
                <label for="Grado_Academico">Grado Academico</label>
                <input id="Grado_Academico" name="grado_academico" type="text" maxlength="11">
                sexo
                <div class="two row radio">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input radio" type="radio" name="sexo" id="inlineRadio1"
                            value="femenino">
                        <label class="form-check-label" for="inlineRadio1">femenino</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input radio" type="radio" name="sexo" id="inlineRadio2"
                            value="masculino">
                        <label class="form-check-label" for="inlineRadio2">masculino</label>
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
                <label for="Naci">Fecha de Nacimiento</label>
                <input type="date" id="Naci" name="naci">
            </div>
            <div class="sel2">
                <label for="Cargo">Cargo</label>
                <select id="Cargo" name="cargo">
                    <option value="">-seleccionar cargo-</option>
                    <?php include("../php/preset/cargosPre.php") ?>
                </select>
                <!-- <input type="text" class="d-none" id="newCargo">
                <label for="newCargo" class="form-label"></label>
                <div class="form-check form-check-inline d-none">
                    <input class="form-check-input" type="checkbox" id="checkNew" value="">
                    <label class="form-check-label" for="checkNew">nuevo cargo</label>
                </div> -->
            </div>
        </div>
        <div class="selects row">
            <div class="sel1">
                <label for="Estados">Estado</label>
                <select id="Estados" name="estado">
                    <option value="0">- seleciona un estado-</option>
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
                <label for="Email">Email</label>
                <input id="Email" name="email" type="text">
            </div>
            <div class="two row">
                <label for="Direccion">Direccion</label>
                <input id="Direccion" name="direccion" type="text">
            </div>
        </div>
        <input type="text" class="d-none" id="tipo" name="tipo" value="0">
        <br>
        <button class="btn btn-lg btn-warning" id="log" type="submit" name="registrar" disabled>Registrar</button>
    </form>
    <script src="../js/formRegistroValidacion.js"></script>
    <script src="../js/selectorScript.js"></script>
    <script src="../js/activarInput.js"></script>
</div>
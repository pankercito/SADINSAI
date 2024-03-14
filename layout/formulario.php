<form action="../php/registroSolicitud.php" method="post" class="col-lg-10 mx-auto justifiy-content-center">
    <div class="col row my-4">
        <div class="col-md-8 row">
            <div class="col mb-3">
                <label for="Name">Nombre</label>
                <input class="form-control" id="Name" name="name" type="text">
            </div>
            <div class="col mb-3">
                <label for="Apellido">Apellido </label>
                <input class="form-control" id="Apellido" name="apellido" type="text">
            </div>
        </div>
        <div class="col row">
            <label>sexo
                <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                    <input type="radio" class="btn-check" name="sexo" id="btncheck1" autocomplete="off"
                        value="no especificado" checked>
                    <label class="radiohead btn btn-outline-secondary" for="btncheck1">no especificado</label>
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
    <div class="col row">
        <div class="col">
            <label for="Ci">Cedula</label>
            <input class="form-control" id="Ci" name="ci" type="num" onblur="verificarCI()">
            <div id="mensajeCi"></div>
        </div>
        <div class="col ">
            <label for="Phone">Telefono </label>
            <input class="form-control" id="Phone" name="telefono" type="text" maxlength="11">
        </div>
        <div class="col">
            <label for="Naci">Fecha de Nacimiento</label>
            <input class="form-control" type="date" id="Naci" name="naci">
        </div>
    </div>
    <div class="col row my-4">
        <div class="col">
            <label for="Grado_Academico">Grado Academico</label>
            <input class="form-control" id="Grado_Academico" name="grado_academico" type="text" maxlength="11">
        </div>
        <div class="col">
            <label for="Email">Email</label>
            <input class="form-control" id="Email" name="email" type="text">
        </div>
        <div class="col">
            <label for="Direccion">Direccion</label>
            <input class="form-control" id="Direccion" name="direccion" type="text">
        </div>
    </div>
    <div class="col row my-4">
        <div class="col">
            <label for="Estados">Estado</label>
            <select class="form-select" id="Estados" name="estado">
                <option value="0">- seleciona un estado-</option>
                <?php include "../php/preset/stadosForm.php" ?>
            </select>
        </div>
        <div class="col">
            <label for="Ciudades">Ciudad</label>
            <select class="form-select" id="Ciudades" name="ciudad">
                <option value="0">- Seleciona una ciudad -</option>
            </select>
        </div>
    </div>
    <h6 class="text-center my-4" style="color: #fafafa">DATOS LABORALES</h6>
    <div class="col row my-4">
        <div class="col ">
            <label for="Depa">Departamento</label>
            <select class="form-select" id="Depa" name="departament">
                <option value="">- seleccionar departamento -</option>
                <?php include "../php/preset/opcionesD.php" ?>
            </select>
        </div>
        <div class="col">
            <label for="Cargo">Cargo</label>
            <select class="form-select" id="Cargo" name="cargo">
                <option value="">- seleccionar cargo -</option>
                <?php include "../php/preset/cargosPre.php" ?>
            </select>
        </div>
        <div class="col">
            <label for="Sede">Sede</label>
            <select class="form-select" id="Sede" name="sede">
                <option value="0">- selecione su sede-</option>
            </select>
        </div>
    </div>
    <input type="text" class="d-none" id="tipo" name="tipo" value="0">
    <br>
    <button class="btn btn-lg btn-warning" id="log" type="submit" name="registrar" disabled>Registrar</button>
</form>
<script src="../js/formRegistroValidacion.js"></script>
<script src="../js/selectorScript.js"></script>
<script src="../js/activarInput.js"></script>
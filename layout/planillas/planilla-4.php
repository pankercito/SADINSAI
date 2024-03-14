<h6>CARTA DE AVAL</h6>
<hr>
<?php include 'planillas_config.php' ?>
<div class="col">
    <h6 class="text-center">
        DATOS DEL TRABAJADOR
    </h6>
</div>
<div class="mb-3 row col align-items-baseline mx-2">
    <div class="col">
        <label for="inputNames" class="col-form-label">Nombres y Apellidos</label>
        <input type="text" class="form-control" name="inputNames" id="inputNames"
            value="<?php echo $_SESSION['getPlanillaNombre'] . ' ' . $_SESSION['getPlanillaApellido'] ?>" readonly>
    </div>
    <div class="col">
        <label for="ced" class="col-form-label">Cedula</label>
        <input type="text" class="form-control" name="ced" id="ced" value="<?php echo $_SESSION['getPlanillaCI'] ?>"
            readonly>
    </div>
    <div class="col">
        <label for="socibioregion" class="col-form-label">Socibioregion</label>
        <input type="text" class="form-control" name="sociobioregion" id="socibioregion"
            value="<?php echo $_SESSION['getPlanillaSede'] ?>" readonly>
    </div>
</div>
<div class="mb-3 row col aling-items-baseline mx-2">
    <div class="col">
        <label for="adscrito" class="col-form-label">Estado</label>
        <input type="text" class="form-control" name="estado" id="adscrito"
            value="<?php echo $_SESSION['getPlanillaEst'] ?>" readonly>
    </div>
    <div class="col">
        <label for="unidad" class="col-form-label">Telefono</label>
        <input type="text" class="form-control" name="phone" id="unidad"
            value="<?php echo $_SESSION['getPlanillaPhon'] ?>" readonly>
    </div>
    <div class="col">
        <label for="ubicacion" class="col-form-label">Telefono de contacto con clinica</label>
        <input type="text" class="form-control" name="celphonN" id="ubicacion" placeholder="Ej: 04121234567">
    </div>
</div>
<div class="col">
    <h6 class="text-center">
        DATOS DEL BENIFECIARIOS
    </h6>
</div>
<div class="mb-3 row col align-items-baseline mx-2">
    <div class="col">
        <label for="fechaingreso" class="col-form-label">Nombre y apellido</label>
        <input type="text" class="form-control" name="nombreBene" id="fechaingreso" placeholder="Nombre">
    </div>
    <div class="col">
        <label for="fechaingres" class="col-form-label">cedula</label>
        <input type="text" class="form-control" name="ciBene" id="fechaingres" placeholder="Ej: 30122133">
    </div>
    <div class="col">
        <label for="fechaingresos" class="col-form-label">Parentesco</label>
        <input type="text" class="form-control" name="parent" id="fechaingresos" placeholder="Ej: hijos">
    </div>
    <div class="col">
        <label for="organismos" class="col-form-label">Documentos a consignar</label>
        <input type="text" class="form-control" name="organismos" id="organismos" placeholder="Ej: cedula">
    </div>
</div>
<div class="mb-3 row col align-items-baseline mx-2">
    <div class="col">
        <h6 class="col">Origen de:</h6>
        <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
            <input type="radio" class="btn-check" name="origen" id="btncheck1"
                value="informe amplio y detallado del medico tratante" autocomplete="off">
            <label class="btn btn-outline-light" for="btncheck1">informe amplio y
                detallado del médico tratante</label>

            <input type="radio" class="btn-check" name="origen" id="btncheck2" value="presupuesto vigente"
                autocomplete="off">
            <label class="btn btn-outline-light" for="btncheck2">presupuesto vigente</label>
        </div>
    </div>
    <div class="col">
        <h6 class="col">Fotocopias de:</h6>
        <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
            <input type="radio" class="btn-check" name="fotocopia" id="btncheck3" value="examenes que diagnostiquen
                    la enfermedad" autocomplete="off">
            <label class="btn btn-outline-light" for="btncheck3">exámenes que diagnostiquen
                la enfermedad</label>

            <input type="radio" class="btn-check" name="fotocopia" id="btncheck4"
                value="copia de partida de nacimiento de los hijos" autocomplete="off">
            <label class="btn btn-outline-light" for="btncheck4">copia de partida de
                nacimiento de los hijos</label>

            <input type="radio" class="btn-check" name="fotocopia" id="btncheck5"
                value="Cedula del beneficiario y trabajador" autocomplete="off">
            <label class="btn btn-outline-light" for="btncheck5">Cedula del beneficiario y
                trabajador</label>

        </div>
    </div>
</div>
<div class="mb-3 row col align-items-baseline mx-2">
    <div class="col">
        <label for="Diagnostico">Diagnostico</label>
        <input name="diagnostico" id="Diagnostico" class="form-control" type="text" placeholder="Diagnostico">
    </div>
    <div class="col">
        <label for="Observaciones">Observaciones</label>
        <input name="observaciones" id="Observaciones" class="form-control" type="text" placeholder="Observaciones">
    </div>
</div>
<div class="col">
    <input type="text" class="d-none" value="4" name="formtipo">
    <?php include "planilla_button.php" ?>
</div>
</form>
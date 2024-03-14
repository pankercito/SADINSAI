<h6>SOLICITUD DE PERMISO</h6>
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
        <input type="text" class="form-control" name="inputNames" id="inputNames" placeholder="Name" readonly
            value="<?php echo $_SESSION['getPlanillaNombre'] . ' ' . $_SESSION['getPlanillaApellido'] ?>">
    </div>
    <div class="col">
        <label for="ced" class="col-form-label">Cedula</label>
        <input type="text" class="form-control" name="ced" id="ced" placeholder="Name" readonly
            value="<?php echo $_SESSION['getPlanillaCI'] ?>">
    </div>
    <div class="col">
        <label for="fecha" class="col-form-label">fecha</label>
        <input type="date" class="form-control" name="fecha" id="fecha" value="<?php echo date('Y-m-d') ?>">
    </div>
    <div class="col">
        <label for="fechaingreso" class="col-form-label">Fecha de ingreso</label>
        <input type="date" class="form-control" name="fechaingreso" id="fechaingreso" placeholder="dd/mm/aa">
    </div>
</div>
<div class="mb-3 row col aling-items-baseline mx-2">
    <div class="col">
        <label for="cargo" class="col-form-label">Denominacion de cargo</label>
        <input type="text" class="form-control" name="cargo" id="cargo" placeholder="Name"
            value="<?php echo $_SESSION['getPlanillaCargo'] ?>" readonly>
    </div>
    <div class="col">
        <label for="adscrito" class="col-form-label">Unidad de adscripcion</label>
        <input type="text" class="form-control" name="adscrito" id="adscrito" placeholder="Name"
            value="<?php echo $_SESSION['getPlanillaSede'] ?>" readonly>
    </div>
    <div class="col">
        <label for="direccion" class="col-form-label">Direccion/oficina</label>
        <input type="text" class="form-control" name="direccion" id="direccion" placeholder="Name"
            value="<?php echo $_SESSION['getPlanillaDepart'] ?>" >
    </div>
</div>
<h6 class="text-center">NUMERO DE DIAS</h6>
<div class="mb-3 row col align-items-baseline mx-2">
    <div class="col">
        <label for="diasH" class="col-form-label">Días habiles</label>
        <input type="text" class="form-control" name="diasH" id="diasH" placeholder="Ej: 12 dias">
    </div>
    <div class="col">
        <label for="diasC" class="col-form-label">Días continuos</label>
        <input type="text" class="form-control" name="diasC" id="diasC" placeholder="Ej: 12 dias">
    </div>
</div>
<h6 class="text-center">FECHAS</h6>
<div class="mb-3 row col align-items-baseline mx-2">
    <div class="col">
        <label for="inicio" class="col-form-label">Inicio</label>
        <input type="date" class="form-control" name="inicio" id="inicio" placeholder="dd-mm-aa">
    </div>
    <div class="col">
        <label for="regreso" class="col-form-label">Regreso</label>
        <input type="date" class="form-control" name="regreso" id="regreso" placeholder="dd-mm-aa">
    </div>
</div>
<h6 class="text-center">CAUSA ESPECIFICA</h6>
<div class="mb-3 row col align-items-baseline mx-2">
    <div class="col">
        <input type="text" name="causa" id="causa" class="form-control" placeholder="causa">
    </div>
</div>
<div class="col">
    <input type="text" class="d-none" value="2" name="formtipo">
    <?php include "planilla_button.php" ?>
</div>
</form>
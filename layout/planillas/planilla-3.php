<?php
session_start();
?>
<h6>SOLICITUD DE VACACIONES</h6>
<hr>
<?php include 'planillas_config.php' ?>
<div class="col">
    <h6 class="text-center">
        DATOS DEL SOLICITANTE
    </h6>
</div>
<div class="mb-3 row col align-items-baseline mx-2">
    <div class="col">
        <label for="codigo" class="col-form-label">codigo</label>
        <input type="text" class="form-control" name="codigo" id="codigo" placeholder="codigo">
    </div>
    <div class="col">
        <label for="fecha" class="col-form-label">fecha</label>
        <input type="date" class="form-control" name="fecha" id="fecha" value="<?php echo date('Y-m-d') ?>">
    </div>
    <div class="col">
        <label for="codigoNomina" class="col-form-label">codigo de nomina</label>
        <input type="text" class="form-control" name="codigoNomina" id="codigoNomina" placeholder="codigo">
    </div>
</div>
<div class="mb-3 row col align-items-baseline mx-2">
    <div class="col">
        <label for="inputNames" class="col-form-label">nombres y apellidos</label>
        <input type="text" class="form-control" name="inputNames" id="inputNames"
            value="<?php echo $_SESSION['getPlanillaNombre'] . ' ' . $_SESSION['getPlanillaApellido'] ?>" readonly>
    </div>
    <div class="col">
        <label for="cin" class="col-form-label">C.I.N</label>
        <input type="text" class="form-control" name="cin" id="cin" value="<?php echo $_SESSION['getPlanillaCI'] ?>"
            readonly>
    </div>
    <div class="col">
        <label for="cargo" class="col-form-label">cargo</label>
        <input type="text" class="form-control" name="cargo" id="cargo"
            value="<?php echo $_SESSION['getPlanillaCargo'] ?>" readonly>
    </div>
    <div class="col">
        <label for="adscrito" class="col-form-label">adscrito a</label>
        <input type="text" class="form-control" name="adscrito" id="adscrito"
            value="<?php echo $_SESSION['getPlanillaDepart'] ?>" readonly>
    </div>
    <div class="col">
        <label for="unidad" class="col-form-label">unidad</label>
        <input type="text" class="form-control" name="unidad" id="unidad"
            value="<?php echo $_SESSION['getPlanillaSede'] ?>" readonly>
    </div>
</div>
<div class="mb-3 row col align-items-baseline mx-2">
    <div class="col">
        <label for="ubicacion" class="col-form-label">ubicacion</label>
        <input type="text" class="form-control" name="ubicacion" id="ubicacion"
            value="<?php echo $_SESSION['getPlanillaEst'] ?>" readonly>
    </div>
    <div class="col">
        <label for="fechaingreso" class="col-form-label">fecha de ingreso al insai</label>
        <input type="date" class="form-control" name="fechaingreso" id="fechaingreso" placeholder="Name">
    </div>
    <div class="col">
        <label for="organismos" class="col-form-label">tiempo de servicio en otros organismos publicos</label>
        <input type="text" class="form-control" name="organismos" id="organismos" placeholder="Name">
    </div>
    <div class="col">
        <label for="tiempototal" class="col-form-label">total de tiempo en la administracion publica</label>
        <input type="text" class="form-control" name="tiempototal" id="tiempototal" placeholder="Name">
    </div>
</div>

<div class="mb-3 row col align-items-baseline mx-2">
    <div class="col">
        <label for="periodo">periodo vacacional</label>
        <input type="text" name="periodo" placeholder="dias" id="periodo" class="form-control">
    </div>
    <div class="col">
        <label for="habiles">dias habiles a disfrutar</label>
        <input type="text" name="habiles" placeholder="dias" id="habiles" class="form-control">
    </div>
    <div class="col">
        <label for="cantidad">cantidad</label>
        <input type="text" name="cantidad" placeholder="cantidad" id="observaciones" class="form-control">
    </div>
    <div class="col">
        <label for="incorporacion">fecha de incorporacion</label>
        <input type="date" name="incorporacion" placeholder="observaciones" id="observaciones" class="form-control">
    </div>
</div>
<div class="col">
    <input type="text" class="d-none" value="3" name="formtipo">
    <?php include "planilla_button.php" ?>
</div>
</form>
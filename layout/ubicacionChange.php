<?php include "../php/preset/ubicacionPre.php" ?>
<div class="col-md-11 mx-auto">
    <div class="alert alert-secondary mb-3 mt-3">
        <div class="col">
            <label class="form-label">Ubicacion actual:</label>
            <p class="mb-0">
                <?php echo $UbicacionA ?>
            </p>
        </div>
        <hr>
        <div class="col">
            <label class="form-label">Responsable actual:</label>
            <p class="mb-0">
                <?php echo $responsable ?>
            </p>
        </div>
    </div>
    <form id="germain">
        <div class="col mb-3">
            <label for="resp" class="form-label">Responsable</label>
            <input type="text" name="responsable" id="send" class="d-none" value="">
            <input type="text" class="form-control" aria-describedby="helpId1" id="resp" autocomplete="off"
                placeholder="buscar por nombre, apellido o ci">
            <small id="helpId1" class="form-text text-muted">nombre del encargado del documento</small>
            <div id="lista"></div>
        </div>
        <button type="button" class="btn btn-sm btn-success " id="veriff">verificar personal</button>
        <div class="mb-3">
            <label for="nDirecion" class="form-label">Direccion</label>
            <select class="form-select form-select-lg" name="ndireccion" id="nDirecion">
                <option value=""> seleccione una direccion </option>
                <?php include "../php/preset/opcionesD.php" ?>
            </select>
        </div>
    </form>
</div>
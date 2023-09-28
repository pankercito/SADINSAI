<h6>carta de aval</h6>
<form action="" method="post">
    <div class="mb-3 row col align-items-baseline">
        <div class="col">
            <label for="codigo" class="col-form-label">codigo</label>
            <input type="text" class="form-control" name="codigo" id="codigo" placeholder="Name">
        </div>
        <div class="col">
            <label for="fecha" class="col-form-label">fecha</label>
            <input type="date" class="form-control" name="fecha" id="fecha" placeholder="Name">
        </div>
        <div class="col">
            <label for="codigoNomina" class="col-form-label">codigo de nomina</label>
            <input type="text" class="form-control" name="codigoNomina" id="codigoNomina" placeholder="Name">
        </div>
    </div>
    <div class="mb-3 row col align-items-baseline">
        <div class="col">
            <label for="inputNames" class="col-form-label">nombres y apellidos</label>
            <input type="text" class="form-control" name="inputNames" id="inputNames" placeholder="Name">
        </div>
        <div class="col">
            <label for="cin" class="col-form-label">C.I.N</label>
            <input type="text" class="form-control" name="cin" id="cin" placeholder="Name">
        </div>
        <div class="col">
            <label for="cargo" class="col-form-label">cargo</label>
            <input type="text" class="form-control" name="cargo" id="cargo" placeholder="Name">
        </div>
        <div class="col">
            <label for="adscrito" class="col-form-label">adscrito a</label>
            <input type="text" class="form-control" name="adscrito" id="adscrito" placeholder="Name">
        </div>
        <div class="col">
            <label for="unidad" class="col-form-label">unidad</label>
            <input type="text" class="form-control" name="unidad" id="unidad" placeholder="Name">
        </div>
    </div>
    <div class="mb-3 row col align-items-baseline">
        <div class="col">
            <label for="ubicacion" class="col-form-label">ubicacion</label>
            <input type="text" class="form-control" name="ubicacion" id="ubicacion" placeholder="Name">
        </div>
        <div class="col">
            <label for="fechaingreso" class="col-form-label">fecha de ingreso</label>
            <input type="text" class="form-control" name="fechaingreso" id="fechaingreso" placeholder="Name">
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
    <div class="mb-3 row col align-items-baseline">
        <h6 class="mb-2">motivo de anticipo</h6>
        <div class="col row no-color align-items-baseline">
            <h6>Construccion de vivienda</h6>
            <div class="col d-grid align-items-baseline">
                <label for="motivoanticipo" class="mb-0">adquisicion de vivienda</label>
                <input class="" type="radio" name="motivoanticipo" id="motivoanticipo">
                <label for="motivoanticipo2" class="mb-0"> mejora o reparacion de vivienda</label>
                <input class="" type="radio" name="motivoanticipo" id="motivoanticipo2">
            </div>
        </div>
        <div class="col row no-color align-items-baseline">
            <h6>liberacion de hipoteca</h6>
            <div class="form-check-inline">
                <label for="motivoanticipo" class="mb-2">sobre la vivienda</label>
                <input class="" type="radio" name="motivoanticipo" id="motivoanticipo">
                <label for="motivoanticipo2" class="mb-2">otro gravamen</label>
                <input class="" type="radio" name="motivoanticipo" id="motivoanticipo2">
            </div>
        </div>
        <div class="col row no-color align-items-baseline">
            <h6>pago de pension escolar</h6>
            <div class="form-check-inline">
                <input class="form-control-checkbox" type="radio" name="motivoanticipo" id="motivoanticipo">
            </div>
        </div>
        <div class="col row no-color align-items-baseline">
            <h6>gastos medicos</h6>
            <div class="form-check-inline">
                <label for="motivoanticipo" class="mx-2">trabajador</label>
                <input class="" type="radio" name="motivoanticipo" id="motivoanticipo">
                <label for="motivoanticipo" class="mx-2">conyugue</label>
                <input class="" type="radio" name="motivoanticipo" id="motivoanticipo">
                <label for="motivoanticipo2" class="mx-2">hijos</label>
                <input class="" type="radio" name="motivoanticipo" id="motivoanticipo2">
            </div>
        </div>
        <div class="col">
            <label for="observaciones">observaciones</label>
            <input type="text" name="observaciones" id="observaciones" class="form-control">
        </div>
    </div>
    <div class="col">
        <button type="submit" class="btn btn-success">procesar</button>
    </div>
</form>
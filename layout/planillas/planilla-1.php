<?php
session_start();
?>
<h6>ANTICIPO</h6>
<hr>
<form action="../php/solisPlanlillas.php" method="post">
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
    <h6 class="col">MOTIVO DE ANTICIPO</h6>
    <div class="mb-3 row col align-items-baseline mx-2">
        <div class="col">
            <h6 class="col">Construccion de vivienda</h6>
            <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                <input type="radio" class="btn-check" name="motivode" id="btncheck1" autocomplete="off"
                    value="Vivienda Adquisición devivienda">
                <label class="btn btn-outline-light" for="btncheck1">Adquisición devivienda</label>

                <input type="radio" class="btn-check" name="motivode" id="btncheck2" autocomplete="off"
                    value="Vivienda Mejora o reparacion de la vivienda">
                <label class="btn btn-outline-light" for="btncheck2">Mejora o reparacion de la vivienda</label>
            </div>
        </div>
        <div class="col">
            <h6 class="col">Liberación de hipoteca</h6>
            <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                <input type="radio" class="btn-check" name="motivode" id="btncheck3" autocomplete="off"
                    value="Hipoteca Sobre la vivienda">
                <label class="btn btn-outline-light" for="btncheck3">Sobre la vivienda</label>

                <input type="radio" class="btn-check" name="motivode" id="btncheck4" autocomplete="off"
                    value="Hipoteca Otro gravamen">
                <label class="btn btn-outline-light" for="btncheck4">Otro gravamen</label>
            </div>
        </div>
        <div class="col">
            <h6 class="col">Gastos médicos</h6>
            <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                <input type="radio" class="btn-check" name="motivode" id="btncheck5" autocomplete="off"
                    value="Gastos Trabajador">
                <label class="btn btn-outline-light" for="btncheck5">Trabajador</label>

                <input type="radio" class="btn-check" name="motivode" id="btncheck6" autocomplete="off"
                    value="Gastos Cónyugue">
                <label class="btn btn-outline-light" for="btncheck6">Cónyugue</label>
                <input type="radio" class="btn-check" name="motivode" id="btncheck7" autocomplete="off"
                    value="Gastos Hijos">
                <label class="btn btn-outline-light" for="btncheck7">Hijos</label>
            </div>
        </div>
        <div class="col">
            <h6 class="col">Pago de pension escolar</h6>
            <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                <input type="radio" class="btn-check" name="motivode" id="btncheck8" autocomplete="off"
                    value="pago de pension escolar">
                <label class="btn btn-outline-light" for="btncheck8">pago de pension escolar</label>
            </div>
        </div>
    </div>

    <div class="mb-3 row col align-items-baseline mx-2">

        <div class="col-md-5 mx-auto">
            <label for="observaciones">observaciones</label>
            <input type="text" name="observaciones" placeholder="observaciones" id="observaciones" class="form-control">
        </div>
    </div>
    <div class="col">
        <input type="text" class="d-none" value="1" name="formtipo">
        <button type="submit" class="btn btn-success btn-lg">procesar</button>
    </div>
</form>
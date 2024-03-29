<?php
session_start();
?>
<h6>SOLICITUD DE PERMISO</h6>
<hr>
<form action="../php/solisPlanlillas.php" method="post">
    <div class="col">
        <h6 class="text-center">
            DATOS DEL TRABAJADOR
        </h6>
    </div>
    <div class="mb-3 row col align-items-baseline mx-2">
        <div class="col">
            <label for="inputNames" class="col-form-label">Nombres y Apellidos</label>
            <input type="text" class="form-control" name="inputNames" id="inputNames" placeholder="Name" readonly >
        </div>
        <div class="col">
            <label for="ced" class="col-form-label">Cedula</label>
            <input type="text" class="form-control" name="ced" id="ced" placeholder="Name" readonly >
        </div>
        <div class="col">
            <label for="socibioregion" class="col-form-label">Socibioregion</label>
            <input type="text" class="form-control" name="socibioregion" id="socibioregion" placeholder="Name" readonly >
        </div>
    </div>
    <div class="mb-3 row col aling-items-baseline mx-2">
        <div class="col">
            <label for="adscrito" class="col-form-label">Estado</label>
            <input type="text" class="form-control" name="adscrito" id="adscrito" placeholder="Name" readonly >
        </div>
        <div class="col">
            <label for="unidad" class="col-form-label">Telefono</label>
            <input type="text" class="form-control" name="unidad" id="unidad" placeholder="Name" readonly >
        </div>
        <div class="col">
            <label for="ubicacion" class="col-form-label">Telefono de contacto con clinica</label>
            <input type="text" class="form-control" name="ubicacion" id="ubicacion" placeholder="Name">
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
            <input type="text" class="form-control" name="fechaingreso" id="fechaingreso" placeholder="Name">
        </div>
        <div class="col">
            <label for="fechaingreso" class="col-form-label">cedula</label>
            <input type="text" class="form-control" name="fechaingreso" id="fechaingreso" placeholder="Name">
        </div>
        <div class="col">
            <label for="fechaingreso" class="col-form-label">Parentesco</label>
            <input type="text" class="form-control" name="fechaingreso" id="fechaingreso" placeholder="Name">
        </div>
        <div class="col">
            <label for="organismos" class="col-form-label">Documentos a consignar</label>
            <input type="text" class="form-control" name="organismos" id="organismos" placeholder="Name">
        </div>
    </div>
    <div class="mb-3 row col align-items-baseline mx-2">
        <div class="col">
            <h6 class="col">Origen de:</h6>
            <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                <input type="radio" class="btn-check" name="origen" id="btncheck1" autocomplete="off">
                <label class="btn btn-outline-light" for="btncheck1">informe amplio y
                    detallado del médico tratante</label>

                <input type="radio" class="btn-check" name="origen" id="btncheck2" autocomplete="off">
                <label class="btn btn-outline-light" for="btncheck2">presupuesto vigente</label>
            </div>
        </div>
        <div class="col">
            <h6 class="col">Fotocopias de:</h6>
            <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                <input type="radio" class="btn-check" name="fotocopia" id="btncheck3" autocomplete="off">
                <label class="btn btn-outline-light" for="btncheck3">exámenes que diagnostique
                    la enfermedad</label>

                <input type="radio" class="btn-check" name="fotocopia" id="btncheck4" autocomplete="off">
                <label class="btn btn-outline-light" for="btncheck4">copia de partida de
                    nacimiento de los hijos</label>

                <input type="radio" class="btn-check" name="fotocopia" id="btncheck5" autocomplete="off">
                <label class="btn btn-outline-light" for="btncheck5">Cedula del beneficiario y
                    trabajador</label>

            </div>
        </div>
    </div>
    <div class="mb-3 row col align-items-baseline mx-2">
        <div class="col">
            <label for="Diagnostico">Diagnostico</label>
            <input name="diagnostico" id="Diagnostico" class="form-control" type="text" value="Button">
        </div>
        <div class="col">
            <label for="Observaciones:">Observaciones</label>
            <input name="observaciones:" id="Observaciones:" class="form-control" type="text" value="Button">
        </div>
    </div>
    <div class="col">
        <input type="text" class="d-none" value="2" name="formtipo">
        <button type="submit" class="btn btn-success btn-lg" disabled>procesar</button>
    </div>
</form>
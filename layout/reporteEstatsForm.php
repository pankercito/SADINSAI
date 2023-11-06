<div class="contereport mt-3">
    <form id="report">
        <div class="row justify-content-center mx-auto my-3 c">
            <div class="col row mx-auto  justify-content-center">
                <div class="col-sm-6 mb-3">
                    <label for="fecha" class="form-label">fecha</label>
                    <input type="date" class="form-control" name="fecha" id="fecha" aria-describedby="helpId" placeholder="">
                    <small id="helpId" class="form-text text-muted">iterar sobre un dia</small>
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="fecha2" class="form-label">fecha 2 </label>
                    <input type="date" class="form-control" name="fecha2" id="fecha2" aria-describedby="helpId2"
                        placeholder="">
                    <small id="helpId2" class="form-text text-muted">iterar en rango de fechas (opcional )</small>
                </div>
                <div class="col mb-3">
                    <label for="" class="form-label">tipo de reporte</label>
                    <select class="form-select form-select" name="selectipo" id="selectipo">
                        <option selected value="0">selecciona una opción</option>
                        <option value="4">general</option>
                        <option value="1">solicitudes</option>
                        <option value="2">archivos</option>
                        <option value="3">usuarios</option>
                    </select>
                </div>
            </div>
            <div class="col row mx-auto  justify-content-center"> 
                <div class="col mb-3">
                    <h6 class="text-center">opciones</h6>
                    <hr>
                    <div class="col row justify-content-center" id="contenOpcion" >
                    </div>
                </div>
            </div>

        </div>

    </form>
</div>
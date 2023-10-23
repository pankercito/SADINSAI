<div class="tablesoli">
    <div class="col-lg-3 mx-auto">
        <h6 class="col" style="color:white;">estado de solicitudes</h6>
        <label class="d-flex">
            <select name="coro" class="form-select " id="estado">
                <option value="">selecione una opcion</option>
                <option value="0">Pendiente</option>
                <option value="1">Aceptadas</option>
                <option value="2">Rechazadas</option>
                <option value="3">Anuladas</option>
            </select>
        </label>
    </div>
    <table class="admin-table table table-striped table-class" id="table">
        <thead>
            <tr>
                <th>SOLICITUD</th>
                <th>EMISOR</th>
                <th>FECHA</th>
                <th>TIPO</th>
                <th>DETALLES</th>
                <th>ESTADO / ACCIONES</th>
                <th>filtro</th>
            </tr>
        </thead>
    </table>
</div>
<script src="../js/tablaAdmin.js"></script>
<script src="../js/solicitudes.js"></script>
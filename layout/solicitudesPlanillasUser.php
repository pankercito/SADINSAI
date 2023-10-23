<div class="admin">
    <div class="col-lg-3 mx-auto">
        <h6 class="col" style="color:white;">estado de solicitudes</h6>
        <label class="d-flex">
            <select name="coro" class="form-select " id="estado">
                <option value="">selecione una opcion</option>
                <option value="1">Pendiente</option>
                <option value="2">Aceptadas</option>
                <option value="3">Rechazadas</option>
                <option value="4">Anuladas</option>
            </select>
        </label>
    </div>

    <table class="user-table table-light table table-striped table-class" id="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">TIPO</th>
                <th scope="col">SOLICITANTE</th>
                <th scope="col">FECHA</th>
                <th scope="col">DETALLES</th>
                <th scope="col">ACCIONES</th>
                <th scope="col">filtro</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
<script src="../js/tablaPlanillasUser.js"></script>
</div>
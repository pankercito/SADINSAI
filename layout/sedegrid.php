<div class="stades">
    <table class="states-table table-light table-striped table-sm w-auto data">
        <thead class="table-light">
            <tr>
                <th class="text-end"><a></a></th>
                <th class="text-end" style="border-left: none;"><a>Estado</a></th>
                <th class="text-end" style="border-left: ;"><a>nombre</a></th>
                <th class="text-end" style="border-left: ;"><a>apellido</a></th>
                <th class="text-end" style="border-left: ;"><a>telefono</a></th>
            </tr>
        </thead>
        <tbody>
            <?php 
            include('php/grid-sede.php')
            ?>
        </tbody>
    </table>
</div>
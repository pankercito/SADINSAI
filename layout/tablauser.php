<style>
.estructur-conten {
    margin: 2%;
    margin-top: 2rem;
}
</style>

<div class="registersuser">
    <table class="table table-light table-striped table-sm w-auto data">
        <thead class="table-light">
            <tr>
                <th class="text-end"><a></a></th>
                <th class="text-end"><a>Cedula</a></th>
                <th class="text-end"><a>Nombre</a></th>
                <th class="text-end"><a>Apellido</a></th>
                <th class="text-end"><a>usuario</a></th>
            </tr>
        </thead>
        <tbody>
            <?php 
            include('../php/viewRegister.php')
            ?>
        </tbody>
    </table>
</div>
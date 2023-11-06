<?php require "../php/sesionval.php" ?>

<?php require "../php/adp.php" ?>

<?php require "../layout/head.php" ?>

<?php require "../layout/navbar.php" ?>

<script type="text/javascript">
    localStorage.setItem('activeSection', '6');
</script>

<!--SALUDO DE BIENVENIDA-->
<?php
include "../layout/sidebar.php";
?>

<div class="grid-containerr">
    <div class="row col d-flex">
        <div class="col-3 mx-auto flex-column d-flex justify-conten-center">
            <h6 style="color: #e7e7e7;">Acciones</h6>
            <hr style="border-color:white;">
            <div class="col flex-item mt-3">
                <button class="btn btn-warning" type="button" data-bs-toggle="collapse" data-bs-target="#contentId"
                    aria-expanded="false" aria-controls="contentId">
                    Agregar Cargo
                </button>
                <div class="collapse" id="contentId">
                    <form class="col-8 my-4 flex-column d-flex mx-auto justify-conten-center">
                        <label> Agregar nuevo cargo
                            <input type="text" name="cargo" id="cargo" class="form-control">
                        </label>
                        <button type="submit" class="btn btn-primary my-3" id="agregar">agregar</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col text-center">
            <h4 class="mx-auto mb-2 mt-0" style="color: #e7e7e7;">CARGOS</h4>
            <hr style="border-color:white;">
            <div class="col-11 mt-5 mx-auto">
                <div class="mx-auto">
                    <table class="table table-striped 
                    table-hover	
                    table-primary
                    align-middle" id="table">
                        <thead class="table-light">
                            <tr>
                                <th>N°</th>
                                <th>NOMBRE</th>
                                <th>TOTAL DE EMPLEADOS</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<style>
    .grid-containerr>div {
        margin: 1.5rem;
        background-color: var(--bg-conten-color);
        text-align: center;
        padding: 20px 0;
        border-radius: 10px;
    }

    .grid-containerr>div .btn {
        height: 3rem;
        box-shadow: 0px 2px 0 0px #00000054;
    }

    label {
        color: #e7e7e7;
    }
</style>
<script src="../js/componentes.js"></script>

<?php require "../layout/footer.php" ?>
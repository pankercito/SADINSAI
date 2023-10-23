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
        <div class="col-2 mx-auto flex-column d-flex justify-conten-center">
            <h5 style="color: #e7e7e7;">Acciones</h5>
            <hr style="border-color:white;">
            <div class="col flex-item">
                <button class="btn btn-warning mx-3 mb-3">
                    Respaldar Base de Datos
                </button>
                <button class="btn btn-light" type="button" data-bs-toggle="collapse" data-bs-target="#contentId"
                    aria-expanded="false" aria-controls="contentId">
                    Rectaurar
                </button>
                <div class="collapse" id="contentId">
                    <form class="col-8 my-4 flex-column d-flex mx-auto justify-conten-center">
                        <label> ingrese id del Respaldo
                            <input type="text" name="cargo" id="cargo" class="form-control">
                        </label>
                        <button type="submit" class="btn btn-primary my-3">agregar</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col text-center">
            <h4 class="mx-auto mb-2 mt-0" style="color: #e7e7e7;">RESPALDOS</h4>
            <hr style="border-color:white;">
            <div class="col-10 mt-5 mx-auto">
                <table class="table table-primary">
                    <thead>
                        <th>
                            N°
                        </th>
                        <th>
                            ID
                        </th>
                        <th>
                            NOMBRE
                        </th>
                        <th>
                            FECHA DE CREACION
                        </th>
                        <th>
                            PESO
                        </th>
                    </thead>
                    <tbody>
                        <?php

                        for ($i = 10; $i < 30; $i++) {
                            ?>

                            <tr>
                                <td>
                                    <?php echo $i ?>
                                </td>
                                <td>
                                    <?php echo $i . $i . $i . $i . $i . $i . $i ?>
                                </td>
                                <td>respaldo</td>
                                <td>
                                    <?php echo "20$i-05-$i" ?>
                                </td>
                                <td>$i</td>
                            </tr>
                            <?php
                        }

                        ?>
                    </tbody>
                </table>
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

    button.btn.btn-warning.mx-3.mb-3 {
        height: 4rem;
    }

    label {
        color: #e7e7e7;
    }
</style>

<?php require "../layout/footer.php" ?>
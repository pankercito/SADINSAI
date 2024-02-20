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
                <button class="btn btn-warning mx-3 mb-3" onclick="respaldar()">
                    Respaldar Base de Datos
                </button>
            </div>
        </div>
        <div class="col text-center">
            <h4 class="mx-auto mb-2 mt-0" style="color: #e7e7e7;">RESPALDOS</h4>
            <hr style="border-color:white;">
            <div class="col-10 mt-5 mx-auto">
                <table class="table table-primary" id='table'>
                    <thead>
                        <th>
                            N°
                        </th>
                        <th>
                            archivo
                        </th>
                        <th>
                            download
                        </th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<style>
    a.btn.btn-success {
        font-size: large;
        width: 4rem;
    }

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

    td {
        vertical-align: -webkit-baseline-middle;
    }
</style>
<script>
    let table = $('#table').DataTable({
        ajax: {
            url: 'RespaldoList.php',
            data: 'data'
        },
        order: [[1, 'des']]
    });

    function respaldar() {

        $.confirm({
            title: '',
            content: "<h5 class='text-center'>¿Esta seguro de realizar este Backup? <h5><br><h6 class='text-center'>no podra eliminarlo mas tarde</h6>",
            buttons: {
                bue: {
                    text: "si, estoy seguro",
                    btnClass: "btn-success",
                    action: function () {
                        $.ajax({
                            url: "../private/backupDB.php",
                            success: function (cc) {
                                if (cc == 'true') {
                                    notie.alert({
                                        type: 1,
                                        text: 'Se Realizo el backup correctamente',
                                        time: 3
                                    });

                                    table.ajax.reload(null, false);

                                } else {
                                    notie.alert({
                                        type: 2,
                                        text: 'Relizar Backup falló',
                                        time: 3
                                    });
                                }

                            }
                        });
                    }
                },
                car: {
                    text: "no, cancelar",
                    btnClass: "btn-danger",
                    action: function () {
                    }
                }
            }
        });
    }
</script>
<?php require "../layout/footer.php" ?>
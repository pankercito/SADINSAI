<?php require("../layout/head.php"); ?>

<link rel="stylesheet" href="../styles/admin.css">
<link rel="stylesheet" href="../styles/background.css">

<div class="content">
    <div class="col-lg-12 d-flex">
        <div class="fless col-lg-5">
            <form id="pinform">
                <h5 class="text-center">Registro de Administrador</h5>
                <label for="pin" class="form-label">Pin</label>
                <input id="pin" type="text" class="form-control" name="pin" maxlength="8" aria-describedby="mensajePin"
                    autocomplete="off">
                <small id="mensajePin" class="form-text text-muted">Ingrese el pin de registro</small>
                <button class="consul btn btn-primary" id="verify">consultar</button>
            </form>
            <a href="" class="text-center btn mx-auto" id="soli">solicitar pin</a>
        </div>
    </div>
</div>
<script src="../js/adminPriv.js"></script>
<?php require("../layout/head.php"); ?>

<link rel="stylesheet" href="../styles/recovery.css">
<link rel="stylesheet" href="../styles/background.css">

<div class="content">
    <div class="col-lg-12 d-flex">
        <div class="fless col-lg-5">
            <form>
                <h5 class="text-center">Recuperacion de Contraseña</h5>
                <label for="ci" class="ci form-label">cedula</label>
                <input id="ci" type="text" class="form-control" name="cedula" maxlength="8" aria-describedby="mensajeCi"
                    autocomplete="off">
                <small id="mensajeCi" class="form-text text-muted">ingrese su numero de cedula</small>
                <button class="consul btn btn-primary" id="verify">consultar</button>
                <a href="../index.php" class="mt-3 col-sm-5 mx-auto btn btn">inicio de sesion</a>
            </form>
        </div>
    </div>
</div>
<script src="../js/recovery.js"></script>
<?php require "../layout/head.php" ?>

<link rel="stylesheet" href="../styles/recovery.css">
<div class="col row">
    <img src="../resources/sadinverde.png" class="logo" alt="logo">
</div>
<div class="content">
    <div class="col-lg-12 d-flex">
        <div class="fless col-lg-5">
            <form>
                <h5 class="text-center">Activar cuenta</h5>
                <label for="ci" class="ci form-label">cedula</label>
                <input id="ci" type="text" class="form-control" name="cedula" maxlength="8" aria-describedby="mensajeCi"
                    autocomplete="off">
                <small id="mensajeCi" class="form-text text-muted">ingrese su numero de cedula</small>
                <button class="consul btn btn-primary" id="verify">consultar</button>
                <a href="../index.php" class="mt-4 mx-auto text-center p-1 nav-link">inicio de sesion</a>
            </form>
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
<script src="../js/active_user.js"></script>
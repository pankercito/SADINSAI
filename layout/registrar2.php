<?php
require("../php/adp.php");
?>
<link rel="stylesheet" href="../styles/regiform.css">
<script src="../js/userCheck.js"></script>
<div class="conten-regisform mx-auto">
    <div class="progress my-3" style="height: 3px; width: 30%;">
        <div class="progress-bar bg-danger" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0"
            aria-valuemax="100"></div>
    </div>
    <a href="javascript:history.back()" class="btn btn-light">volver</a>
    <div class="col-md-2 mx-auto mt-4">
        <form method="post" action="?adminregister=true" class="mx-auto" name="regisform" id="rgt" require>
            <div class="form-group">
                <label for="user">usuario</label>
                <input class="form-control" id="user" type="text" name="user" placeholder="usuario" maxlength="30"
                    required autocomplete="off">
                <small class="form-text" id="msjverify"></small>
            </div>
            <div class="form-group my-3">
                <label for="pass">contraseña</label>
                <input class="form-control" type="password" id="pass" name="pass" placeholder="contraseña" required
                    autocomplete="off" disabled>
                <small class="form-text" id="passmsj"></small>
            </div>
            <div class="form-group my-3">
                <label for="vpass">verificar contraseña</label>
                <input class="form-control" type="password" id="vpass" name="vpass" placeholder="contraseña" required
                    autocomplete="off" disabled>
                <small class="form-text" id="vpassmsj"></small>
            </div>
            <div class="form-group my-3">
                <label for="pass">pin</label>
                <input class="form-control" type="password" id="pin" name="pin" placeholder="pin" maxlength="4" required
                    autocomplete="off" disabled>
            </div>
            <div class="form-group my-3">
                <div class="contenSwitch">
                    <div class="form-check form-switch">
                        <label class="form-check-label" for="flexSwitchCheckChecked">Condecer permiso de Admin</label>
                        <input class="form-check-input" name="checkadmin" type="checkbox" id="flexSwitch" value="1"
                            disabled>
                    </div>
                </div>
            </div>
            <button type="submit" id="singup" name="singup" class="btn btn-warning" disabled>Registrar</button>
        </form>
    </div>

</div>
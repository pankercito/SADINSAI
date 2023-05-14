<?php
    require("../php/adp.php");
?>
<link rel="stylesheet" href="../styles/regiform.css">
<div class="col-lg-6">
    <div class="conten-regisform">
        <div class="progress " style="height: 3px; width: 30%;">
            <div class="progress-bar bg-danger" role="progressbar"  style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <a href="javascript:history.back()" class="btn btn-secondary">Atras</a>
        <form method="post" action="?adminregister=true" class="regisform"  name="regisform" id="rgt" require>
            <div class="form-group">
                <legend>Usuario</legend>
                <input class="regis1" id="user" type="text" name="user" placeholder="usuario" maxlength="30" onblur="verify_user();" required>
                
                <div class="msjverify" id="msjverify"></div>
            </div>
            <script src="../sadinsai/js/user-check.js"></script>
            <div class="form-group">
                <legend>Contraseña</legend>
                <input class="regis2" type="password" name="pass" placeholder="contraseña" maxlength="12" required>
            </div> 
            <div class="form-group">
                <div class="checkadmin alert alert-danger">
                    <p>Condecer permiso Admin</p>
                    <div class="checkform">
                        <input type="checkbox" class="form-item" id="conditions" name="checkadmin" value="1">
                        <label class="form-item" for="conditions"></label> 
                    </div>
                </div>
            </div>
            <button type="submit" name="singup" class="btn btn-defaul">Registrar</button>
        </form>
    </div>
</div>
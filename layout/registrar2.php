<?php
    include("php/adp_1.php");
?>
<div class="col-lg-6">
    <div class="conten-regisform">
        <div class="progress " style="height: 3px; width: 30%;">
            <div class="progress-bar bg-danger" role="progressbar"  style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <a href="?users/register=true" class="btn btn-secondary">Atras</a>
        <form method="post" action="?adminregister=true" class="regisform"  name="regisform" id="rgt" require>
            <fieldset>
                <div class="form-group">
                    <legend>Usuario</legend>   
                    <input type="text" name="user" placeholder="usuario" maxlength="30" required>
                </div>
            </fieldset>
            <fieldset>
                <div class="form-group">
                    <legend>Contraseña</legend>
                    <input type="password" name="pass" placeholder="contraseña" maxlength="12" required>
                </div> 
            </fieldset>
            <fieldset>
                <div class="form-group">
                    <div class="alert alert-danger">
                        <p>Condecer permiso Admin</p>
                        <div class="checkform">
                            <input type="checkbox" class="form-item" id="conditions" name="checkadmin" value="1">
                            <label class="form-item" for="conditions"></label> 
                        </div>
                    </div>
                </div>
                <button type="submit" name="singup" class="btn btn-defaul">Registrar</button>
            </fieldset>
        </form>
    </div>
</div>
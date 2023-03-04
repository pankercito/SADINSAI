<?php
    include("php/adp_1.php");
?>
<<<<<<< HEAD

=======
>>>>>>> ef454668b094ed648e94e17d925e51a7f585f6bd
<div class="col-lg-6">
    <div class="conten-regisform">
        <div class="progress " style="height: 3px; width: 30%;">
            <div class="progress-bar bg-danger" role="progressbar"  style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <a href="javascript:history.back()" class="btn btn-secondary">Atras</a>
        <form method="post" action="?adminregister=true" class="regisform"  name="regisform" id="rgt" require>
            <fieldset>
                <div class="form-group">
                    <legend>Usuario</legend>   
<<<<<<< HEAD
                    <input id="user" type="text" name="user" placeholder="usuario" maxlength="30" required>
                </div>
                <?php
                    require ("php/fallo.php");
                ?>
=======
                    <input type="text" name="user" placeholder="usuario" maxlength="30" required>
                </div>
>>>>>>> ef454668b094ed648e94e17d925e51a7f585f6bd
            </fieldset>
            <fieldset>
                <div class="form-group">
                    <legend>Contraseña</legend>
                    <input type="password" name="pass" placeholder="contraseña" maxlength="12" required>
                </div> 
            </fieldset>
            <fieldset>
                <div class="form-group">
<<<<<<< HEAD
                    <div class="checkadmin alert alert-danger">
=======
                    <div class="alert alert-danger">
>>>>>>> ef454668b094ed648e94e17d925e51a7f585f6bd
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
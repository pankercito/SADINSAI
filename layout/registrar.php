<div class="col-lg-6">
    <div class="conten-regisform">
        <div class="progress " style="height: 3px; widght: 50%;">
            <div class="progress-bar bg-danger" role="progressbar" style="width: 33%"  aria-valuenow="33" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        
        <form method="post" action="?adminregister=true" class="regisform"  name="regisform" id="rgt" require>
            <legend>Cedula</legend>
            <input type="int" name="cedula" placeholder="cedula" maxlength="8" required>

            <legend>Nombre</legend>   
            <input type="text" name="name" placeholder="Nombre" maxlength="30" required>

            <legend>Usuario</legend>   
            <input type="text" name="user" placeholder="usuario" maxlength="30" required>
    
            <legend>Contraseña</legend>
            <input type="password" name="pass" placeholder="contraseña" maxlength="12" required>

            <div class="alert alert-danger">
                <p>Condecer permiso Admin</p>
                <div class="checkform">
                    <input type="checkbox" class="form-item" id="conditions" name="checkadmin" value="1">
                    <label class="form-item" for="conditions"></label> 
                </div>
            </div>
            <button type="submit" name="singup" class="btn btn-defaul">Registrar</button>
        </form>
    </div>
</div>
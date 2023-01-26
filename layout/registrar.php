<div class="col-lg-6">
    <form method="post" action="conect.php" class="regisform"  name="regisform" id="rgt">
        <legend>Cedula</legend>
        <input type="int" name="cedula" placeholder="cedula" maxlength="8">

        <legend>Nombre</legend>
        <input type="text" name="nombre" placeholder="nombre" maxlength="20">

        <legend>Usuario</legend>
        <input type="text" name="user" placeholder="usuario" maxlength="30">
    
        <legend>Contraseña</legend>
        <input type="password" name="pass" placeholder="contraseña" maxlength="12">

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
<?php

if (isset($_GET["fallo"])) {
    echo "<div class='alert alert-danger' style='color:red'>
    Usuario y/o contraseña invalido</div>
            <style>
                .alert {
                    position: relative;
                    padding: 0.75rem 1.25rem;
                    margin-top: 0.5rem;
                    border: 1px solid transparent;
                    border-radius: 5px;
                    margin-bottom: -15px;
                }
            </style>";
}
if (isset($_GET["session-dup"])) {
    ?>

    <script type="text/javascript">
        
        setTimeout(() => {
            $.dialog({
                title: '',
                type: 'orange',
                animation: 'RotateX',
                closeAnimation: 'scale',
                typeAnimated: true,
                content: '<h2 class="text-center mx-auto">Sesion duplicada</h2><br><h5 class="text-center mx-auto pb-3 px-4">este usuario ya tiene una sesion activa</h5>',
            })
        }, 300);
    </script>

    <?php
}
if (isset($_GET["userdes"])) {
    ?>

    <script type="text/javascript">
       setTimeout(() => {
         $.dialog({
             title: '',
             animation: 'RotateX',
             type: 'red',
             icon: 'bi bi-warning',
             typeAnimated: true,
             content: '<h2 class="text-center mx-auto">Usuario desactivado</h2><br><h5 class="text-center mx-auto pb-3 px-4">por favor active su usuario para poder ingresar</h5>',
         })
       }, 300);
    </script>
    <?php
}

if (isset($_GET["userinhal"])) {
    ?>

    <script type="text/javascript">
       setTimeout(() => {
         $.dialog({
             title: '',
             animation: 'RotateX',
             type: 'red',
             icon: 'bi bi-warning',
             typeAnimated: true,
             content: '<h2 class="text-center mx-auto">Usuario inhabilidato</h2><br><h5 class="text-center mx-auto pb-3 px-4">comuniquese con el departamento de Tecnologia</h5>',
         })
       }, 300);
    </script>
    <?php
}
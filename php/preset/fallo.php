<?php 

if (isset($_GET['users/register/cvfail'])){
    echo "
    Estas intentando registrar a una persona que no se encuentra en la empresa 
    para continuar, primero debe <a href='?form=true'>agregar personal</a>";
}

if (isset($_GET['users/registerfall'])){
    echo "<div class='alert alert-danger' style='color:red'>
               Este usuario ya se encuentra registrado</div>
               <style>
               div.alert {
                    background-color: #f8d7da;
                    text-align: center;
                    margin: auto;
                    position: relative;
                    width: 12.56rem;
                    margin-top: -35px;
                    padding-top: 2rem;
                    padding-left: 0.2rem;
                    padding-bottom: 10px;
                    padding-right: 0.2rem;
                    border-radius: 10px;
                }
               </style>";
}
if (isset($_GET['erroruser'])){
    echo "<div id='usererror' class='alert alert-danger' style='color:red'>
               Este usuario ya se encuentra en uso</div>
               <style>
               #usererror {
                background-color: #f8d7da;
                text-align: center;
                margin: auto;
                margin-top: -2.5rem;
                position: relative;
                width: 192px;
                padding-top: 30px;
                padding-left: 0.2rem;
                padding-bottom: 10px;
                padding-right: 0.2rem;
                font-size: 50%;
                border-radius: 10px;
                }
               </style>";
}
if(isset($_GET["fallo"])){
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
if(isset($_GET["session-dup"])){
    echo'<div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close"><i class="bi bi-x-square"></i></span>
                <p>Este usuario ya tiene una sesion iniciada</p>
            <script src="js/modal.js"></script>
            </div>
            <style>
            .modal {
                display: none; /* Ocultar el modal por defecto */
                position: fixed; /* Fijar posición */
                z-index: 1; /* Establecer la profundidad */
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: rgba(0,0,0,0.4); /* Fondo oscuro */
              }
              
              /* Estilos para el contenido del modal */
            .modal-content {
                background-color: #fefefe;
                margin: 15% auto;
                padding: 20px;
                border: 1px solid #888;
                width: 24rem;
            }              
            /* Estilos para el texto de modal */
            #myModal p {
                margin: 2rem 0;
            }
              /* Estilos para el botón de cerrar */
            .close{right: 0;
                position: absolute;
                width: 2rem;
                color: #000;
                float: right;
                font-size: 28px;
                font-weight: bold;
                margin: -0.5rem 0.5rem;
            }      
            .close:hover,
            .close:focus {
                text-decoration: none;
                cursor: pointer;
            </style>
        </div>';
}else{

}
<?php 

if (isset($_GET['users/registerfall'])){
    echo "<div class='alert alert-danger' style='color:red'>
               Este usuario ya se encuentra registrado</div>
               <style>
               div.alert {
                background-color: #f8d7da;
                text-align: center;
                margin: auto;
                position: relative;
                width: 192px;
                margin-top: -35px;
                padding-top: 30px;
                padding-left: 0.2rem;
                padding-bottom: 10px;
                padding-right: 0.2rem;
                font-size: 50%;
                border-radius: 10px;
                }
               </style>";
<<<<<<< HEAD
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
=======
>>>>>>> 55d05f745a4f7d3d2e337ea2b3f8c7d9c882ffbe
}
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
}
<?php

if(isset($_GET['perfil'])){
    
   echo 'active';
}else
if(isset($_GET['users'])){

   echo 'active';
}else
if(isset($_GET['users/viewregister'])){

   echo "active";
}else
if(isset($_GET['users/register'])){

   echo "active";
}else
if(isset($_GET['users/register-two'])){

   echo "active";
}else
if(isset($_GET['states'])){

   echo "active";
}else
if(isset($_GET['nomina'])){

   echo "active";
}else{
   echo("");
}

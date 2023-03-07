<?php 

session_start();

if(isset($_SESSION['nombredelusuario']))
{
    $pname = $_SESSION['perfilname'];
    $plastname= $_SESSION['perfillastname'];
    $pphone= $_SESSION['perfilphone'];
}
<?php 

session_start();

if(isset($_SESSION['sesioninit']))
{
    $pname = $_SESSION['perfilname'];
    $plastname= $_SESSION['perfillastname'];
    $pphone= $_SESSION['perfilphone'];
}
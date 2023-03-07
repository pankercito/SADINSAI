<?php

include ("conect.php");

$regisview = mysqli_query($connec,"SELECT * FROM $v_tabla WHERE $v_colum = $v_data ");
   
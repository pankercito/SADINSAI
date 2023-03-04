<?php
    sleep(1);

    include("conect.php");

    if(isset($_REQUEST["user"])) { //<-- Verificas que exista el index "cedula"

        $cedula = $_REQUEST['user'];
        $query = "select * from registro WHERE user = '".strtolower($cedula)."'";
        $results = mysql_query( $query) or die(mysql_error());
    
        if(mysql_num_rows(@$results) > 0){
            echo '<div id="Error">Cedula ya existente</div>'; 
        }else{
            echo '<script type="text/javascript">
                document.getElementById("singup").disabled = false;
                </script>';
        }
}
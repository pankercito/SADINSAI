<?php

//pendiente
$url = "perfil.php?perfil=" . $wci;

if ($adpval == TRUE) {
   
}else{
   
   if (!headers_sent()) {
      header('Location: '.$url);
      exit;
  }else{
      echo '<script>
               window.location.replace("'.$url.'");
            </script>';
   
      echo '<noscript>
               <meta http-equiv="refresh" content="0;url='.$url.'">
            </noscript>';
      exit;   
   }
}
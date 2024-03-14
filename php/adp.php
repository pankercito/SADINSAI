<?php

//pendiente
$url = "../public/perfil.php?perfil=" . $wci;

if (!$adpval == TRUE) {
   if (!headers_sent()) {
      header("Location: $url");
      exit;
   } else {
      echo "<script>\n window.location.replace(\"$url\");\n</script>";

      echo "<noscript>\n <meta http-equiv=\"refresh\" content=\"0;url=$url\">\n </noscript>";
      exit;
   }
}
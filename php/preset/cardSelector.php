<?php

$archivos = $_GET["g"];
@$multi = $_GET["m"];

//array de valores aqui
include "arrayArchives.php";

function reverse($cadena)
{
  return substr($cadena, strrpos($cadena, '.') + 1);
}

include "../php/preset/cardsPreset.php";

// Comprobamos si el valor de la opción está en el array
if (array_key_exists($archivos, $direcciones)) {
  if ($count > 0) {
    if (!$multi) {
      include "../layout/cardOnly.php";

      // DESACTIVAR BOTON SI HAY ARCHIVO 
      ?>
      <script type="text/javascript">
        document.getElementById('newDoc').setAttribute("disabled", true);
      </script>
      <?php
    } else {
      // si hay un solo archivo usa el cardOnly pero no bloquea el boton
      if ($count == 1) {
        include "../layout/cardOnly.php";
      } else {
        include "../layout/cards.php";
      }
    }
  } else {
    ?>
    <div class="noCard mx-auto text-center">
      <p>no hay documentos en esta seccion</p>
    </div>
    <?php
  }
} else {
  // Si no está, mostramos un mensaje de error
  echo "Opción no válida";
}
?>
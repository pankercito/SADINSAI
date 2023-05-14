<?php
         for($i = 0; $i < 6; $i++){  
            echo '
            <link rel="stylesheet" href="../styles/cards.css">
            <div class="card">
              <div class="card__image-holder">
                <img class="card__image" src="https://picsum.photos/298/225?random='.rand(10, 100 ).'" alt="random" />
              </div>
              <div class="card-title">
                <a href="#" class="toggle-info btn">
                  <span class="left"></span>
                  <span class="right"></span>
                </a>
                <h2>
                  Titulo de tarjeta
                  <small>Subido el 02 del 92</small>
                </h2>
              </div>
                <div class="card-flap flap1">
                <div class="card-description">
                  This grid is an attempt to make something nice that works on touch devices. Ignoring hover states when they re not available etc.
                </div>
                <div class="card-flap flap2">
                  <div class="card-actions">
                    <a href="#" class="btn">¿Abrir o Editar?</a>
                  </div>
                </div>
              </div>
            </div>';
}
?>
<script src="../js/cards.js"></script>
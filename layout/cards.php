<link rel="stylesheet" href="../styles/cards.css">
<?php
         for($i = 0; $i < 6; $i++){  
            echo '
            <div class="card">
              <div class="card__image-holder">
                <img class="card__image" src="../data/archives/1001/7309962043825730=localhost 524ec7038464.jpg" alt="fotos" />
              </div>
              <div class="card-title">
                <a href="#" class="toggle-info btn btn-success">
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
                  Breve descripcion del archivo.
                </div>
                <div class="card-flap flap2">
                  <div class="card-actions">
                    <a href="#" class="btn btn-primary">Abrir</a>
                    <a href="#" class="btn btn-secondary">Editar</a>
                  </div>
                </div>
              </div>
            </div>';
}
?>
<script src="../js/cards.js"></script>
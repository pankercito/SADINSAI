// Obtener el modal
var modal = document.getElementById("myModal");

// Mostrar el modal en milisegundos
setTimeout(function() {
  modal.style.display = "block";
}, 10);

// Obtener el botón de cerrar
var closeBtn = document.getElementsByClassName("close")[0];

// Cerrar el modal al hacer clic en el botón de cerrar
closeBtn.onclick = function() {
  modal.style.display = "none";
}
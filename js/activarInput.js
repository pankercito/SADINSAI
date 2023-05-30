const buttonLog = document.getElementById('log');
const sedeSelect = document.getElementById('Sede');
const estadoSelect = document.getElementById('Estados');
const ciudadSelect = document.getElementById('Ciudades');

function enableButton() {
    const inputs = [inputName, inputLastName, inputCi, inputDireccion, inputPhone, inputEmail];
    
    const allInputsLlenos = inputs.every(input => input.value.trim() !== '');
    const allSelectsActivos = estadoSelect.selectedIndex !== 0 && sedeSelect.selectedIndex !== 0 && ciudadSelect.selectedIndex !== 0;
    //La funcion ".toggle" agrega o quita una clase CSS dependiendo de si la clase ya existe o no
    buttonLog.classList.toggle('disabled', !(allInputsLlenos && allSelectsActivos));
  }

// Llama a la función enableButton cada vez que se escriba algo en los campos o se seleccione una opción en los selectores
[inputName, inputLastName, inputCi, inputDireccion, inputPhone, inputEmail, estadoSelect, ciudadSelect, sedeSelect].forEach(element => {
  element.addEventListener('input', enableButton);
  element.addEventListener('change', enableButton);
});
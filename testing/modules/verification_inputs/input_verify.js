class VerificarCampo {
    values = [];
    inputs = [];
    boton;

    static ErrorInput = 'classErrorInput';

    constructor() {

    }

    add({ list }) {
        let data = list;

        data.forEach(element => {
            this.inputs.push(element);
        });

    }

    setBoton(bot) {
        this.boton = bot;
    }

    getBoton() {
        return this.boton;
    }

    verify() {
        let bool = false;
        let finalBool = 0;

        this.inputs.forEach(element => {
            let input = element[0];
            let inputValue = input.value;
            let limit = element[1];


            if (inputValue.length >= limit) {
                this.values.push(true);
                input.classList.remove(VerificarCampo.ErrorInput);

            } else {
                this.values.push(false);
                input.classList.add(VerificarCampo.ErrorInput);
            }
        });

        this.values.forEach(element => {
            finalBool = element == true ? finalBool + 1 : finalBool;
        });

        finalBool = finalBool == this.values.length ? true : false;

        if (finalBool == true) {
            this.activar();
            alert('activado');
        } else {
            this.desactivar();
        }

        return bool;
    }

    activar() {
        this.boton.removeAttribute("disabled");
    }

    desactivar() {
        this.boton.setAttribute("disabled", true);
    }
}




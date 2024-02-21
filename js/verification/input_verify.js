class VerificarCampo {
    values = [];
    inputs = [];
    radio = []
    radioc = false;
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

        // RECORRER ARRAY DE ELEMENTOS HTML
        this.inputs.forEach(element => {
            let input = element[0];
            let inputValue = input.value;
            let limit = element[1];

            console.log(input);
            if (input.type == 'radio') {
                // RADIO VALIDATION
                if (input.checked == true) {
                    this.radio.push(true);
                } else {
                    this.radio.push(false);
                }

                this.radioc = true;

            } else if (inputValue.length >= limit) {
                this.values.push(true);
                input.classList.remove(VerificarCampo.ErrorInput);
            } else {
                this.values.push(false);
                input.classList.add(VerificarCampo.ErrorInput);
            }
        });

        if (this.radioc == true) {
            if (this.radio.some(element => element === true)) {
                this.values.push(true);
            } else {
                this.values.push(false);
            }
        }



        console.log('radio' + this.radio);
        console.log(this.values.length);
        console.log(finalBool);

        this.values.forEach(element => {
            finalBool = element == true ? finalBool + 1 : finalBool;
        });

        console.log(finalBool);

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
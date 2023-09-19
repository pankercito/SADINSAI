<div class="d-flex justify-content-center py-5">
    <div>
        <label class="text-center d-block h5 text-uppercase font-weight-normal mb-3" for="unique-pin">ingrese su pin de
            verificacion</label>
        <input class="form-control form-control-lg form-masked-pin error validation-demo" id="unique-pin" type="number"
            maxlength="4" autofocus />
        <div class="mx-auto text-center">
            <small id="pinMsj"></small>
        </div>
    </div>
</div>

<script type="text/javascript">

    // Next step: Add validation demo

</script>


<style>
    .form-masked-pin+.bg-box-group .bg-box {
        width: 14%;
        height: 65px;
        margin-top: -65px;
        display: block;
        border-radius: 3px;
        border: 1px solid #777;
        background: #fff;
    }

    /* Hide Default text highlighting */
    .form-masked-pin::selection {
        background: transparent;
        /* WebKit/Blink Browsers */
    }

    .form-masked-pin::-moz-selection {
        background: transparent;
        /* Gecko Browsers */
    }

    /*Hide number input's built-in arrows -
Chrome, Safari, Edge, Opera */
    input.form-masked-pin::-webkit-outer-spin-button,
    input.form-masked-pin::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number].form-masked-pin {
        -moz-appearance: textfield;
    }

    .form-masked-pin.error+.bg-box-group .bg-box {
        /* box-shadow: 0 0 0 0.055rem rgba(255, 0, 0, 1); */
        /* border-color: red; */
    }

    .form-masked-pin+.bg-box-group .bg-box {
        width: 14%;
        height: 47px;
        margin: -56px 0.8rem 0;
        display: block;
        border-radius: 3px;
        border: 1px solid #777;
        background: #f3f3f3;
    }

    input.form-masked-pin {
        width: 295px;
        height: 65px;
        overflow: hidden;
        font-size: 2rem;
        text-align: start;
        letter-spacing: 3.5rem;
        border: none !important;
        background: none !important;
        box-shadow: none !important;
        text-indent: 3.1rem;
        position: relative;
        padding: 0;
        margin: auto;
        font-family: 'Roboto Mono', monospace;
    }

</style>
let btnCloseScript = document.querySelectorAll('.close-script');
let btnEditScript = document.querySelectorAll('.edit-script');

btnCloseScript.forEach(element => {
    element.addEventListener('click', function(){
        document.getElementById('scriptDatosVehiculo').classList.add('d-hide');
        document.getElementById('scriptConductor').classList.add('d-hide');
        document.getElementById('scriptCotizacion').classList.add('d-hide');
        document.getElementById('scriptPoliza').classList.add('d-hide');

        document.getElementById('divCommentDatosVehiculo').classList.remove('d-hide');
        document.getElementById('divCommentDatosConductor').classList.remove('d-hide');
        document.getElementById('divCommentCot').classList.remove('d-hide');
        document.getElementById('divCommentPoliza').classList.remove('d-hide');

        document.getElementById('datosVehiculo').children[2].classList.add('mt-100');
        document.getElementById('conductorHabitual').children[0].classList.add('mt-100');
        document.getElementById('seguro').children[0].classList.add('mt-100');
        document.getElementById('cambioSeguro').children[0].classList.add('mt-100');
        document.getElementById('cotizacion').children[3].classList.add('mt-100');
        document.getElementById('divFormPoliza').children[0].classList.add('mt-100');
    });
});

document.getElementById('close-script-save-compra').addEventListener('click', function() {
    document.getElementById('guardarCompra').classList.add('d-hide');
    document.getElementById('divComentGuardarCompra').classList.remove('d-hide');
    document.getElementById('divFormCompra').children[0].classList.add('mt-100');
});

document.getElementById('close-script-continue-compra').addEventListener('click', function() {
    document.getElementById('continuarCompra').classList.add('d-hide');
    document.getElementById('divCommentContinuarCompra').classList.remove('d-hide');
    document.getElementById('divFormCompra').children[0].classList.add('mt-100');
});

document.getElementById('divCommentDatosVehiculo').addEventListener('click', function() {
    this.classList.add('d-hide');
    document.getElementById('scriptDatosVehiculo').classList.remove('d-hide');
    document.getElementById('datosVehiculo').children[2].classList.remove('mt-100');
});

document.getElementById('divCommentDatosConductor').addEventListener('click', function() {
    this.classList.add('d-hide');
    document.getElementById('scriptConductor').classList.remove('d-hide');
    document.getElementById('conductorHabitual').children[0].classList.remove('mt-100');
    document.getElementById('seguro').children[0].classList.remove('mt-100');
    document.getElementById('cambioSeguro').children[0].classList.remove('mt-100')
});

document.getElementById('divCommentCot').addEventListener('click', function() {
    this.classList.add('d-hide');
    document.getElementById('scriptCotizacion').classList.remove('d-hide');
    document.getElementById('cotizacion').children[3].classList.remove('mt-100');
});

document.getElementById('divComentGuardarCompra').addEventListener('click', function() {
    this.classList.add('d-hide');
    document.getElementById('guardarCompra').classList.remove('d-hide');
    document.getElementById('divFormCompra').children[0].classList.remove('mt-100');
});

document.getElementById('divCommentContinuarCompra').addEventListener('click', function() {
    this.classList.add('d-hide');
    document.getElementById('continuarCompra').classList.remove('d-hide');
    document.getElementById('divFormCompra').children[0].classList.remove('mt-100');
});

document.getElementById('divCommentPoliza').addEventListener('click', function() {
    this.classList.add('d-hide');
    document.getElementById('scriptPoliza').classList.remove('d-hide');
    document.getElementById('divFormPoliza').children[0].classList.remove('mt-100');
});
let radioBtnSi = document.getElementById('si');
let radioBtnNo = document.getElementById('no');
let radioBtnConductorSi = document.getElementById('siConductor');
let radioBtnConductorNo = document.getElementById('noConductor');
let radioBtnSeguroSi = document.getElementById('siSeguro');
let radioBtnSeguroNo = document.getElementById('noSeguro');
let radioBtnCompraSi = document.getElementById('siCompra');
let radioBtnCompraNo = document.getElementById('noCompra');
let formCot = document.getElementById('formPreCot');
let formConductor = document.getElementById('formConductorHabitual');
let btnContinueVehiculo = document.getElementById('btnDatosVehiculo');
let btnAnteriorConductor = document.getElementById('btnDatosConductorAnterior');
let btnContinueConductor = document.getElementById('btnDatosConductor');
let btnAnteriorSeguro = document.getElementById('btnDatosSeguroAnterior');
let btnContinueSeguro = document.getElementById('btnDatosSeguro');
let btnAnteriorCambioSeguro = document.getElementById('btnCambioSeguroAnterior');
let btnContinueCambioSeguro = document.getElementById('btnCambioSeguro');
let btnAnteriorCotizacion = document.getElementById('btnCotizacionAnterior');
let btnRecotizar = document.getElementById('btnCompraAnterior');
let btnContinueCompra = document.getElementById('btnContinuarCotizacion');
let btnRecotizacionPoliza = document.getElementById('btnRecotizarPoliza');
let btnConfCompra = document.getElementById('btnCompra');
let btnEnviarAPago = document.getElementById('enviarCotizacionPago');
let btnContinueDatos = document.getElementById('btnContinuarDatos');
let btnAceptarPago = document.getElementById('aceptarPago');
let menu = document.querySelector('.sidebar-menu');
let btnCerrarLead = document.getElementById('aceptarCerrarLead');
let btnConclu = document.getElementById('btnConclusion');

radioBtnNo.addEventListener('change', function() {
    if(this.checked = true) {
        formCot.removeAttribute('hidden');
    }
});

radioBtnSi.addEventListener('change', function() {
    if(this.checked = true) {
        formCot.setAttribute('hidden', true);
    }
});

radioBtnConductorNo.addEventListener('change', function() {
    if(this.checked = true) {
        formConductor.removeAttribute('hidden');
    }
});

radioBtnConductorSi.addEventListener('change', function() {
    if(this.checked = true) {
        
    }
});

radioBtnSeguroSi.addEventListener('change', function() {
    if(this.checked = true) {
        formSeguro.removeAttribute('hidden');
    }
});

radioBtnSeguroNo.addEventListener('change', function() {
    if(this.checked = true) {
        formSeguro.setAttribute('hidden', true);
    }
});

radioBtnCompraSi.addEventListener('change', function() {
    if(this.checked = true) {
        document.getElementById('continuarCompra').classList.remove('d-hide');
        document.getElementById('btnCompra').classList.remove('d-hide');
        document.getElementById('formCompra').classList.remove('d-hide');
        document.getElementById('guardarCompra').classList.add('d-hide');
        document.getElementById('btnCompraGuardar').classList.add('d-hide');
    }
});

radioBtnCompraNo.addEventListener('change', function() {
    if(this.checked = true) {
        document.getElementById('continuarCompra').classList.add('d-hide');
        document.getElementById('btnCompra').classList.add('d-hide');
        document.getElementById('formCompra').classList.add('d-hide');
        document.getElementById('guardarCompra').classList.remove('d-hide');
        document.getElementById('btnCompraGuardar').classList.remove('d-hide');
    }
});

btnContinueDatos.addEventListener('click', function() {
    document.getElementById('datosVehiculo').removeAttribute('hidden');
    document.getElementById('saludo').setAttribute('hidden', true);
    document.querySelector('.progressbar').children[1].classList.add('active');
    document.querySelector('.progressbar').children[1].classList.add('active');
    menu.children[1].children[1].children[0].classList.remove('c-yellow');
    menu.children[1].children[1].children[1].classList.add('c-yellow');
});

btnContinueVehiculo.addEventListener('click', function() {
    document.getElementById('datosConductor').removeAttribute('hidden');
    document.getElementById('datosVehiculo').setAttribute('hidden', true);
    document.querySelector('.progressbar').children[1].classList.add('active');
    document.querySelector('.progressbar').children[1].classList.add('active');
    menu.children[1].children[1].children[0].classList.remove('c-yellow');
    menu.children[1].children[1].children[1].classList.add('c-yellow');
});

btnAnteriorConductor.addEventListener('click', function() {
    document.getElementById('datosVehiculo').removeAttribute('hidden');
    document.getElementById('datosConductor').setAttribute('hidden', true);
    document.querySelector('.progressbar').children[1].classList.remove('active');
    menu.children[1].children[1].children[1].classList.remove('c-yellow');
    menu.children[1].children[1].children[0].classList.add('c-yellow');
});

btnContinueConductor.addEventListener('click', function() {
    document.getElementById('seguro').removeAttribute('hidden');
    document.getElementById('conductorHabitual').setAttribute('hidden', true);
});

btnAnteriorSeguro.addEventListener('click', function() {
    document.getElementById('conductorHabitual').removeAttribute('hidden');
    document.getElementById('seguro').setAttribute('hidden', true);
});

btnContinueSeguro.addEventListener('click', function() {
    document.getElementById('cambioSeguro').removeAttribute('hidden');
    document.getElementById('seguro').setAttribute('hidden', true);
});

btnContinueCambioSeguro.addEventListener('click', function() {
    document.getElementById('cotizacion').removeAttribute('hidden');
    document.getElementById('datosConductor').setAttribute('hidden', true);
    document.querySelector('.progressbar').children[2].classList.add('active');
    menu.children[1].children[1].children[1].classList.remove('c-yellow');
    menu.children[1].children[1].children[2].classList.add('c-yellow');
});

btnAnteriorCotizacion.addEventListener('click', function() {
    document.getElementById('cambioSeguro').removeAttribute('hidden');
    document.getElementById('datosConductor').removeAttribute('hidden');
    document.getElementById('cotizacion').setAttribute('hidden', true);
    document.querySelector('.progressbar').children[2].classList.remove('active');
    document.querySelector('.progressbar').children[3].classList.remove('active');
    document.getElementById('cotSucess').classList.add('d-hide');
    document.getElementById('btnContinuarCotizacion').classList.add('d-hide');
    menu.children[1].children[1].children[2].classList.remove('c-yellow');
    menu.children[1].children[1].children[1].classList.add('c-yellow');
});

btnContinueCompra.addEventListener('click', function() {
    document.getElementById('confCompra').removeAttribute('hidden');
    document.getElementById('cotizacion').setAttribute('hidden', true);
    document.querySelector('.progressbar').children[3].classList.add('active');
    menu.children[1].children[1].children[2].classList.remove('c-yellow');
    menu.children[1].children[1].children[3].classList.add('c-yellow');
});

btnRecotizar.addEventListener('click', function() {
    document.getElementById('confCompra').setAttribute('hidden', true);
    document.getElementById('cotizacion').removeAttribute('hidden');
    document.getElementById('cotSucess').classList.add('d-hide');
    document.querySelector('.progressbar').children[4].classList.remove('active');
    document.querySelector('.progressbar').children[3].classList.remove('active');
    menu.children[1].children[1].children[3].classList.remove('c-yellow');
    menu.children[1].children[1].children[2].classList.add('c-yellow');
});

btnRecotizacionPoliza.addEventListener('click', function() {
    document.getElementById('poliza').setAttribute('hidden', true);
    document.getElementById('cotizacion').removeAttribute('hidden');
    document.getElementById('cotSucess').classList.add('d-hide');
    document.querySelector('.progressbar').children[4].classList.remove('active');
    menu.children[1].children[1].children[3].classList.remove('c-yellow');
    menu.children[1].children[1].children[2].classList.add('c-yellow');
    document.getElementById('statusGestion').children[1].setAttribute('hidden', 'true');
});

btnConfCompra.addEventListener('click', function() {
    document.getElementById('confCompra').setAttribute('hidden', true);
    document.getElementById('poliza').removeAttribute('hidden');
    document.querySelector('.progressbar').children[4].classList.add('active');
    document.getElementById('statusGestion').children[1].removeAttribute('hidden');
});

btnEnviarAPago.addEventListener('click', function() {
    document.getElementById('poliza').setAttribute('hidden', true);
    document.getElementById('pago').removeAttribute('hidden');
    document.querySelector('.progressbar').children[5].classList.add('active');
    menu.children[1].children[1].children[3].classList.remove('c-yellow');
    menu.children[1].children[1].children[4].classList.add('c-yellow');
    setTimeout(function(){
        $('#pagoExitoso').modal('show');
        document.querySelector('.progressbar').children[6].classList.add('active');
    }, 3000);
});

btnAceptarPago.addEventListener('click', function() {
    document.getElementById('pago').setAttribute('hidden', true);
    document.getElementById('cierre').removeAttribute('hidden');
    document.querySelector('.progressbar').children[7].classList.add('active');
    menu.children[1].children[1].children[4].classList.remove('c-yellow');
    menu.children[1].children[1].children[5].classList.add('c-yellow');
});

btnCerrarLead.addEventListener('click', function() {
    $('#cerrarLeadModal').modal('hide');
    window.location.href = 'bandeja-entrada.php';
});

btnAnteriorCambioSeguro.addEventListener('click', function() {
    document.getElementById('cambioSeguro').setAttribute('hidden', true);
    document.getElementById('seguro').removeAttribute('hidden');
});

btnConclu.addEventListener('click', function() {
    document.getElementById('cierre').setAttribute('hidden', true);
    document.getElementById('conclusion').removeAttribute('hidden');
    document.querySelector('.progressbar').children[8].classList.add('active');
})

$('#cerrarLead').click(function() {
    $('#cerrarLeadModal').modal('show');
});

$('#btnSolicitudPago').click(function() {
    $('#solicitudPago').modal('show');
});

$('#enviarCotizacion').click(function() {
    $('#cotizacionesSelect').modal('hide');
    document.getElementById('cotSucess').classList.remove('d-hide');
    document.querySelector('.progressbar').children[3].classList.add('active');
    document.getElementById('btnContinuarCotizacion').classList.remove('d-hide');
});